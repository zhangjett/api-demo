<?php

namespace app\modules\v1\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $user_id
 * @property string $phone
 * @property string $password
 * @property string $name
 * @property string $nick_name
 * @property integer $status
 * @property string $access_token
 * @property string $create_time
 * @property string $update_time
 */
class User extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'user';
    }

    public function rules()
    {
        return [
            [['phone', 'password'], 'required', 'on' => ['create', 'login']],
            [['password'], 'required', 'on' => ['updatePassword']],
            [['name', 'nick_name'], 'required', 'on' => ['updateUserInfo']],
            [['password'], 'string', 'length' => [6, 16], 'on' => ['create', 'updatePassword']],
            [['create_time', 'update_time'], 'filter', 'filter' => function ($value) {
                return date('Y-m-d H:i:s');
            }],
            ['password', 'filter', 'filter' => function ($value) {
                return Yii::$app->getSecurity()->generatePasswordHash($value);
            }, 'on' => ['create', 'updatePassword']],
            ['access_token', 'filter', 'filter' => function ($value) {
                return md5(uniqid(md5(microtime(true)),true));
            }, 'on' => ['create']],
            ['phone', 'validatePhone', 'on' => ['create']]
        ];
    }

    public function validatePhone($attribute, $params)
    {
        if (!$this->hasErrors()) {
            //用户是否已经注册
            $data = User::find()
                ->select(['user_id'])
                ->where(['phone' => $this->phone])
                ->one();

            if(!preg_match('/^1[34578]\d{9}$/', $this->phone)){
                $this->addError($attribute, '手机号格式不对');
            }

            if ($data != null) {
                $this->addError($attribute, '手机号已经注册');
            }
        }
    }

    public function scenarios()
    {
        return [
            'create' => ['phone', 'password', 'access_token', 'create_time', 'update_time'],
            'login' => ['phone', 'password'],
            'updatePassword' => ['password', 'update_time'],
            'updateUserInfo' => ['name', 'nick_name', 'update_time'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'user_id' => 'ID',
            'phone' => '手机号',
            'password' => '密码',
            'name' => '姓名',
            'nick_name' => '昵称',
            'status' => '状态',
            'access_token' => 'Access_token',
            'create_time' => '创建时间',
            'update_time' => '修改时间',
        ];
    }
}
