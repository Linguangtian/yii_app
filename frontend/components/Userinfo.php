<?php
namespace frontend\components;


use frontend\models\user\User;
use yii\base\Component;
use yii\base\ErrorException;
use Yii;
class Userinfo  extends Component {

    public $model;
    public $params;
    public $token;
    public $identityClass;


    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
       /* $this->token = Yii::$app->request->post('token');
        $this->setToken( $this->token);*/
    }

    public static function getIsGuest(){

    }

    public function setToken($token)
    {

        if ($token) {
            $this->model = $this->_getUser($token);
        }


    }


    private function _getUser($token){
        if(!$token){
            return null;
        }
        $user = User::findByToken($token);
        return $user;

    }

    /**
     * 检测登录
     * @throws ApiException
     */
    public function checkLogin() {
        if (empty($this->model)) {
            throw new ErrorException(1);
        }
        if ($this->model->status == \frontend\models\user\User::STATUS_DISABLED) {
            throw new ErrorException(2);
        }
    }

    /**
     * 获取模型ID
     * @return int
     */
    public function getId()
    {
        if ($this->model) {
            return $this->model->majorKey(); // 获取主键，model里面的方法需要重写,否则会报错,这里是user的
        }
    }
    /**
     * @inheritdoc
     */
    public function __get($name)
    {

        return $this->model->$name;
    }

}