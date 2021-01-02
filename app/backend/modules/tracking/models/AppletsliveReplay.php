<?php
/**
 * Created by PhpStorm.
 * Author: 芸众商城 www.yunzshop.com
 * Date: 17/2/23
 * Time: 下午10:57
 */

namespace app\backend\modules\tracking\models;

use Illuminate\Database\Eloquent\Model;

use app\common\scopes\UniacidScope;

class AppletsliveReplay extends Model
{
    public static function boot()
    {
        parent::boot();
        self::addGlobalScope(new UniacidScope);
    }

    //小程序直播插件 课程课时表
    protected $table = 'yz_appletslive_replay';

    public $timestamps = false;

    const CREATED_AT = 'create_time';
    //const UPDATED_AT = 'update_time';

    public function resource(){
        return $this->morphOne('App\backend\modules\tracking\models\GoodsTrackingModel','resource');
    }
}