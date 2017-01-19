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
 * @property string $created_at
 * @property string $updated_at
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
            [['password'], 'string', 'length' => [6, 16], 'on' => ['create', 'updatePassword']],
            [['created_at', 'updated_at'], 'filter', 'filter' => function ($value) {
                return time();
            }],
            ['password', 'filter', 'filter' => function ($value) {
                return Yii::$app->getSecurity()->generatePasswordHash($value);
            }, 'on' => ['create', 'saveUpdatePassword']],
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
            'create' => ['phone', 'password', 'access_token', 'created_at', 'updated_at'],
            'login' => ['phone', 'password'],
            'updatePassword' => ['password', 'updated_at'],
            'saveUpdatePassword' => ['password', 'updated_at'],
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
