<?php

namespace Yunshop\MinappContent\models;

use app\common\models\BaseModel;

class FeedbackModel extends BaseModel
{
    const CREATED_AT = 'add_time';
    const UPDATED_AT = null;

    public $table = 'diagnostic_service_feedback';
}
