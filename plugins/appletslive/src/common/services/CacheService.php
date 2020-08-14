<?php
/**
 * Created by PhpStorm.
 * User: weifeng
 * Date: 2020-02-28
 * Time: 12:45
 *
 *    .--,       .--,
 *   ( (  \.---./  ) )
 *    '.__/o   o\__.'
 *       {=  ^  =}
 *        >  -  <
 *       /       \
 *      //       \\
 *     //|   .   |\\
 *     "'\       /'"_.-~^`'-.
 *        \  _  /--'         `
 *      ___)( )(___
 *     (((__) (__)))     梦之所想,心之所向.
 */
namespace Yunshop\Appletslive\common\services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

/**
 * 接口数据缓存服务类
 * Class CacheService
 * @package Yunshop\Appletslive\common\services
 */
class CacheService
{
    protected static $uniacid = 45;

    /**
     * 获取课程基本信息
     * @param int $room_id
     * @return mixed|null
     */
    public static function getRoomInfo($room_id)
    {
        $cache_key = "api_live_room_info|$room_id";
        $cache_val = Cache::get($cache_key);

        if (!$cache_val) {
            self::setRoomInfo($room_id);
            $cache_val = Cache::get($cache_key);
        }

        return $cache_val;
    }

    /**
     * 设置课程基本信息
     * @param $room_id
     * @return mixed
     */
    public static function setRoomInfo($room_id)
    {
        $cache_key = "api_live_room_info|$room_id";
        $cache_val = DB::table('appletslive_room')
            ->select('id', 'type', 'roomid', 'name', 'anchor_name', 'cover_img', 'start_time', 'end_time', 'live_status', 'desc')
            ->where('id', $room_id)
            ->first();
        Cache::forever($cache_key, $cache_val);
    }

    /**
     * 获取课程订阅数、观看数、评论数
     * @param int $room_id
     * @return mixed|null
     */
    public static function getRoomNum($room_id = 0)
    {
        $cache_key = 'api_live_room_num';
        $cache_val = Cache::get($cache_key);

        if (!$cache_val) {
            self::setRoomNum($room_id);
            $cache_val = Cache::get($cache_key);
        }

        if (!$room_id) {
            return $cache_val;
        }

        if (is_array($room_id)) {
            $result = [];
            foreach ($room_id as $v) {
                $key = 'key_' . $v;
                if (!array_key_exists($key, $cache_val)) {
                    self::setRoomNum($room_id);
                    return self::getRoomNum($room_id);
                }
                $result[$key] = $cache_val[$key];
            }
            return $result;
        } else {
            $key = 'key_' . $room_id;
            if (array_key_exists($key, $cache_val)) {
                return $cache_val[$key];
            } else {
                self::setRoomNum($room_id);
                return self::getRoomNum($room_id);
            }
        }
    }

    /**
     * 设置课程订阅数、观看数、评论数（自增1）
     * @param $room_id
     * @param $field subscription_num|view_num|comment_num
     * @return mixed
     */
    public static function setRoomNum($room_id, $field = null)
    {
        if (is_array($room_id)) {
            $record = DB::table('appletslive_room')->whereIn('id', $room_id)->get();
        } else {
            if ($field !== null) {
                DB::table('appletslive_room')->where('id', $room_id)->increment($field);
            }
            $record = DB::table('appletslive_room')->where('id', $room_id)->first();
        }

        $cache_key = 'api_live_room_num';
        $cache_val = Cache::get($cache_key);

        if (is_array($room_id)) {
            foreach ($record as $item) {
                $key = 'key_' . $item['id'];
                $val = [
                    'hot_num' => $item['subscription_num'] + $item['view_num'] + $item['comment_num'],
                    'subscription_num' => $item['subscription_num'],
                    'view_num' => $item['view_num'],
                    'comment_num' => $item['comment_num'],
                ];
                if (!$cache_val) {
                    $cache_val = [$key => $val];
                } else {
                    $cache_val[$key] = $val;
                }
            }
            Cache::forever($cache_key, $cache_val);
        } else {
            $key = 'key_' . $room_id;
            $val = [
                'hot_num' => $record['subscription_num'] + $record['view_num'] + $record['comment_num'],
                'subscription_num' => $record['subscription_num'],
                'view_num' => $record['view_num'],
                'comment_num' => $record['comment_num'],
            ];
            if (!$cache_val) {
                Cache::forever($cache_key, [$key => $val]);
            } else {
                $cache_val[$key] = $val;
                Cache::forever($cache_key, $cache_val);
            }
        }
    }

    /**
     * 获取课程订阅相关信息
     * @param int $room_id
     * @return mixed|null
     */
    public static function getRoomSubscription($room_id = 0)
    {
        $cache_key = "api_live_room_subscription|$room_id";
        $cache_val = Cache::get($cache_key);
        if (!$cache_val) {
            self::setRoomSubscription($room_id);
            $cache_val = Cache::get($cache_key);
        }
        return $cache_val;
    }

    /**
     * 设置课程订阅相关信息
     * @param $room_id
     * @param $user_id
     * @return mixed
     */
    public static function setRoomSubscription($room_id, $user_id = 0)
    {
        $cache_key = "api_live_room_subscription|$room_id";
        $cache_val = Cache::get($cache_key);
        $cache_refresh = false;
        if (!$cache_val) {
            $cache_refresh = true;
            $cache_val = DB::table('appletslive_room_subscription')
                ->where('uniacid', self::$uniacid)
                ->where('room_id', $room_id)
                ->orderBy('id', 'desc')
                ->pluck('create_time', 'user_id')
                ->toArray();
        } else {
            if ($user_id && array_search($user_id, $cache_val) === false) {
                $cache_refresh = true;
                $cache_val[$user_id] = time();
            }
        }
        if ($cache_refresh) {
            if (empty($cache_val)) {
                Cache::forever($cache_key, ['total' => 0, 'list' => []]);
            } else {
                $user = DB::table('diagnostic_service_user')
                    ->whereIn('ajy_uid', array_keys($cache_val))
                    ->select('ajy_uid', 'nickname', 'avatarurl', 'province')
                    ->get()->toArray();
                foreach ($user as $k => $v) {
                    $user['ajy_uid_' . $v['ajy_uid']] = $v;
                    $user[$k] = null;
                }
                $user = array_filter($user);
                array_walk($cache_val, function (&$item, $key) use ($user) {
                    $item = ['user' => $user['ajy_uid_' . $key], 'create_time' => date('Y-m-d H:i', $item)];
                });
                Cache::forever($cache_key, $cache_val);
            }
        }
    }

    /**
     * 获取用户订阅的课程列表
     * @param $user_id
     * @return array
     */
    public static function getUserSubscription($user_id)
    {
        $cache_key = "api_live_user_subscription|$user_id";
        $cache_val = Cache::get($cache_key);
        if (!$cache_val) {
            self::setUserSubscription($user_id);
            $cache_val = Cache::get($cache_key);
        }
        return $cache_val;
    }

    /**
     * @param $user_id
     * @param $room_id
     */
    public static function setUserSubscription($user_id, $room_id = 0)
    {
        $cache_key = "api_live_user_subscription|$user_id";
        $cache_val = Cache::get($cache_key);
        $cache_refresh = false;
        if (!$cache_val) {
            $cache_refresh = true;
            $cache_val = DB::table('appletslive_room_subscription')
                ->where('uniacid', self::$uniacid)
                ->where('user_id', $user_id)
                ->pluck('room_id')->toArray();
        } else {
            if ($room_id && array_search($room_id, $cache_val) === false) {
                $cache_refresh = true;
                $cache_val[] = $room_id;
            }
        }
        if ($cache_refresh) {
            Cache::forever($cache_key, $cache_val);
        }
    }

    /**
     * 获取课程评论相关信息
     * @param int $room_id
     * @return mixed|null
     */
    public static function getRoomComment($room_id)
    {
        $cache_key = "api_live_room_comment|$room_id";
        $cache_val = Cache::get($cache_key);
        if (!$cache_val) {
            self::setRoomComment($room_id);
            $cache_val = Cache::get($cache_key);
        }
        return $cache_val;
    }

    /**
     * 设置课程评论相关信息
     * @param $room_id
     * @return mixed
     */
    public static function setRoomComment($room_id)
    {
        $cache_key = "api_live_room_comment|$room_id";
        $comment = DB::table('appletslive_room_comment')
            ->select('id', 'user_id', 'content', 'create_time', 'parent_id', 'is_reply')
            ->where('uniacid', self::$uniacid)
            ->where('room_id', $room_id)
            ->orderBy('id', 'desc')
            ->get()->toArray();
        if (empty($comment)) {
            Cache::forever($cache_key, ['total' => 0, 'list' => []]);
        } else {
            $user = DB::table('diagnostic_service_user')
                ->whereIn('ajy_uid', array_unique(array_column($comment, 'user_id')))
                ->select('ajy_uid', 'nickname', 'avatarurl', 'province')
                ->get()->toArray();
            foreach ($user as $k => $v) {
                $user['ajy_uid_' . $v['ajy_uid']] = $v;
                $user[$k] = null;
            }
            $user = array_filter($user);
            $reply = [];
            foreach ($comment as $k => $v) {
                if ($v['is_reply']) {
                    array_push($reply, $v);
                    $comment[$k] = null;
                }
            }
            $comment = array_values(array_filter($comment));
            for ($i = 0; $i < count($comment); $i++) {
                $item = $comment[$i];
                $reply_for_this_comment = [];
                foreach ($reply as $k => $v) {
                    if ($v['parent_id'] == $item['id']) {
                        $temp = array_merge($v, ['user' => $user['ajy_uid_' . $v['user_id']]]);
                        $temp['create_time'] = date('Y-m-d H:i:s', $temp['create_time']);
                        unset($temp['user_id']);
                        unset($temp['parent_id']);
                        unset($temp['is_reply']);
                        array_push($reply_for_this_comment, $temp);
                        $reply[$k] = null;
                    }
                }
                $reply = array_filter($reply);
                $item['create_time'] = date('Y-m-d H:i:s', $item['create_time']);
                $item['user'] = $user['ajy_uid_' . $item['user_id']];
                $item['reply'] = ['total' => count($reply_for_this_comment), 'list' => $reply_for_this_comment];
                unset($item['user_id']);
                unset($item['parent_id']);
                unset($item['is_reply']);
                $comment[$i] = $item;
            }
            Cache::forever($cache_key, ['total' => count($comment), 'list' => $comment]);
        }
    }

    /**
     * 获取录播视频观看数、评论数
     * @param int $replay_id
     * @return mixed|null
     */
    public static function getReplayNum($replay_id = 0)
    {
        $cache_key = 'api_live_replay_num';
        $cache_val = Cache::get($cache_key);

        if (!$cache_val) {
            self::setReplayNum($replay_id);
            $cache_val = Cache::get($cache_key);
        }

        if (!$replay_id) {
            return $cache_val;
        }

        if (is_array($replay_id)) {
            $result = [];
            foreach ($replay_id as $v) {
                $key = 'key_' . $v;
                if (!array_key_exists($key, $cache_val)) {
                    self::setReplayNum($replay_id);
                    return self::getReplayNum($replay_id);
                }
                $result[$key] = $cache_val[$key];
            }
            return $result;
        } else {
            $key = 'key_' . $replay_id;
            if (array_key_exists($key, $cache_val)) {
                return $cache_val[$key];
            } else {
                self::setReplayNum($replay_id);
                return self::getReplayNum($replay_id);
            }
        }
    }

    /**
     * 设置录播视频观看数、评论数（自增1）
     * @param $replay_id
     * @param null $field
     * @param int $user_id
     */
    public static function setReplayNum($replay_id, $field = null, $user_id = 0)
    {
        $watch_num = 0;
        $num_table = 'appletslive_replay';
        if (is_array($replay_id)) {
            $num_record = DB::table($num_table)->whereIn('id', $replay_id)->get();
            $watch_record = DB::table('appletslive_replay_watch')
                ->select('replay_id', DB::raw('COUNT(user_id) as watch_num'))
                ->whereIn('replay_id', $replay_id)
                ->groupBy('replay_id')
                ->get()->toArray();
        } else {
            $watch_table = 'appletslive_replay_watch';
            if ($field == 'watch_num') {
                if (!DB::table($watch_table)->where('replay_id', $replay_id)->where('user_id', $user_id)->first()) {
                    DB::table($watch_table)->insert([
                        'uniacid' => self::$uniacid,
                        'replay_id' => $replay_id,
                        'user_id' => $user_id,
                        'create_time' => time(),
                    ]);
                }
            } else {
                DB::table($num_table)->where('id', $replay_id)->increment($field);
            }
            $num_record = DB::table($num_table)->where('id', $replay_id)->first();
            $watch_num = DB::table($watch_table)->where('replay_id', $replay_id)->count();
        }

        $cache_key = 'api_live_replay_num';
        $cache_val = Cache::get($cache_key);

        if (is_array($replay_id)) {
            foreach ($num_record as $item) {
                $key = 'key_' . $item['id'];
                $val = [
                    'hot_num' => $item['view_num'] + $item['comment_num'],
                    'view_num' => $item['view_num'],
                    'comment_num' => $item['comment_num'],
                    'watch_num' => 0,
                ];
                foreach ($watch_record as $wrv) {
                    if ($wrv['replay_id'] == $item['id']) {
                        $val['watch_num'] = $wrv['watch_num'];
                        break;
                    }
                }
                if (!$cache_val) {
                    $cache_val = [$key => $val];
                } else {
                    $cache_val[$key] = $val;
                }
            }
            Cache::forever($cache_key, $cache_val);
        } else {
            $key = 'key_' . $replay_id;
            $val = [
                'hot_num' => $num_record['view_num'] + $num_record['comment_num'],
                'view_num' => $num_record['view_num'],
                'comment_num' => $num_record['comment_num'],
                'watch_num' => $watch_num,
            ];
            if (!$cache_val) {
                Cache::forever($cache_key, [$key => $val]);
            } else {
                $cache_val[$key] = $val;
                Cache::forever($cache_key, $cache_val);
            }
        }
    }

    /**
     * 获取用户看过的视频列表
     * @param $user_id
     * @return array
     */
    public static function getUserWatch($user_id)
    {
        $cache_key = "api_live_user_watch|$user_id";
        $cache_val = Cache::get($cache_key);
        if (!$cache_val) {
            self::setUserWatch($user_id);
            $cache_val = Cache::get($cache_key);
        }
        return $cache_val;
    }

    /**
     * 设置用户看过的视频列表
     * @param $user_id
     * @param $replay_id
     */
    public static function setUserWatch($user_id, $replay_id = 0)
    {
        $cache_key = "api_live_user_watch|$user_id";
        $cache_val = Cache::get($cache_key);
        $cache_refresh = false;
        if (!$cache_val) {
            $cache_refresh = true;
            $cache_val = DB::table('appletslive_replay_watch')
                ->where('uniacid', self::$uniacid)
                ->where('user_id', $user_id)
                ->pluck('replay_id')->toArray();
        } else {
            if ($replay_id && array_search($replay_id, $cache_val) === false) {
                $cache_refresh = true;
                $cache_val[] = $replay_id;
            }
        }
        if ($cache_refresh) {
            Cache::forever($cache_key, $cache_val);
        }
    }

    /**
     * 获取录播视频评论相关信息
     * @param int $replay_id
     * @return mixed|null
     */
    public static function getReplayComment($replay_id)
    {
        $cache_key = "api_live_replay_comment|$replay_id";
        $cache_val = Cache::get($cache_key);
        if (!$cache_val) {
            self::setReplayComment($replay_id);
            $cache_val = Cache::get($cache_key);
        }
        return $cache_val;
    }

    /**
     * 设置录播视频评论相关信息
     * @param $replay_id
     * @return mixed
     */
    public static function setReplayComment($replay_id)
    {
        $cache_key = "api_live_replay_comment|$replay_id";
        $comment = DB::table('appletslive_replay_comment')
            ->select('id', 'user_id', 'content', 'create_time', 'parent_id', 'is_reply')
            ->where('uniacid', self::$uniacid)
            ->where('replay_id', $replay_id)
            ->orderBy('id', 'desc')
            ->get()->toArray();
        if (empty($comment)) {
            Cache::forever($cache_key, ['total' => 0, 'list' => []]);
        } else {
            $user = DB::table('diagnostic_service_user')
                ->whereIn('ajy_uid', array_unique(array_column($comment, 'user_id')))
                ->select('ajy_uid', 'nickname', 'avatarurl', 'province')
                ->get()->toArray();
            foreach ($user as $k => $v) {
                $user['ajy_uid_' . $v['ajy_uid']] = $v;
                $user[$k] = null;
            }
            $user = array_filter($user);
            $reply = [];
            foreach ($comment as $k => $v) {
                if ($v['is_reply']) {
                    array_push($reply, $v);
                    $comment[$k] = null;
                }
            }
            $comment = array_values(array_filter($comment));
            for ($i = 0; $i < count($comment); $i++) {
                $item = $comment[$i];
                $reply_for_this_comment = [];
                foreach ($reply as $k => $v) {
                    if ($v['parent_id'] == $item['id']) {
                        $temp = array_merge($v, ['user' => $user['ajy_uid_' . $v['user_id']]]);
                        $temp['create_time'] = date('Y-m-d H:i:s', $temp['create_time']);
                        unset($temp['user_id']);
                        unset($temp['parent_id']);
                        unset($temp['is_reply']);
                        array_push($reply_for_this_comment, $temp);
                        $reply[$k] = null;
                    }
                }
                $reply = array_filter($reply);
                $item['create_time'] = date('Y-m-d H:i:s', $item['create_time']);
                $item['user'] = $user['ajy_uid_' . $item['user_id']];
                $item['reply'] = ['total' => count($reply_for_this_comment), 'list' => $reply_for_this_comment];
                unset($item['user_id']);
                unset($item['parent_id']);
                unset($item['is_reply']);
                $comment[$i] = $item;
            }
            Cache::forever($cache_key, ['total' => count($comment), 'list' => $comment]);
        }
    }
}
