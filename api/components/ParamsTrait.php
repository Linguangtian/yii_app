<?php
namespace api\components;

trait ParamsTrait{


    public $token       = ''; // 请求token

    protected function initRequest($request)
    {

        $this->token  = $request->post('token');
    }

}