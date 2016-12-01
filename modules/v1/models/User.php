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
            [['password'], 'required', 'on' => ['prepareUpdatePassword', 'updatePassword']],
            [['nick_name', 'gender', 'birthday'], 'required', 'on' => ['updateUserInfo']],
            [['authentication'], 'required', 'on' => ['updateAuthentication']],
            [['gender', 'status'], 'integer'],
            [['password'], 'string', 'length' => [6, 16], 'on' => ['create', 'prepareUpdatePassword']],
            [['phone'], 'integer', 'min' => 10000000000, 'max' => 19999999999],
            [['name'], 'string', 'max' => 32],
            [['email'], 'string', 'max' => 64],
            [['create_time', 'update_time'], 'filter', 'filter' => function ($value) {
                return date('Y-m-d H:i:s');
            }],
            ['password', 'filter', 'filter' => function ($value) {
                return Yii::$app->getSecurity()->generatePasswordHash($value);
            }, 'on' => ['create', 'updatePassword']],
            ['access_token', 'filter', 'filter' => function ($value) {
                return md5(uniqid(md5(microtime(true)),true)).'#2';
            }, 'on' => ['create']],
            ['phone', 'validatePhone', 'on' => ['create']],
            [['access_token', 'create_time', 'update_time'], 'safe'],
        ];
    }

    public function validatePhone($attribute, $params)
    {
        if (!$this->hasErrors()) {
            //用户是否已经注册
            $data = User::find()->select(['user_id'])->where(['phone'=>$this->phone])->one();
            if ($data != null) {
                $this->addError($attribute, '手机号已注册住户');
            }
        }
    }

    public function scenarios()
    {
        return [
            'create' => ['phone', 'password', 'access_token', 'create_time', 'update_time'],
            'login' => ['phone', 'password'],
            'prepareUpdatePassword' => ['phone', 'password', 'update_time'],
            'updatePassword' => ['phone', 'password', 'update_time'],
            'prepareUpdateUserInfo' => ['avatar', 'nick_name', 'gender', 'birthday', 'update_time'],
            'updateUserInfo' => ['avatar', 'nick_name', 'gender', 'birthday', 'update_time'],
            'updateAuthentication' => ['authentication']
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
