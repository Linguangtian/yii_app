<?php

namespace api\exceptions;

use Yii;
use api\helpers\ErrorCode;


class ApiException extends \Exception
{
    /*
     * 重写错误
     * */
    protected $data = [];

    public function __construct( $code = null,$message = null,$data=[])
    {

        if ($code === null) {
            $code = ErrorCode::EC_UNKNOWN;
        }

        if (empty($message)) {
            $message = ErrorCode::errMsg($code);
        }


//        $argv = func_get_args();
//
//        if (!empty($argv[3])) {
//            array_splice($argv, 0, 3, $message);
//            $message = call_user_func_array('sprintf', $argv);
//        }

        parent::__construct($message, $code);
    }
}
