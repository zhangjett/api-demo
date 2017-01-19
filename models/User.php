<?php

namespace app\models;

use Yii;
use yii\db\Query;

class User extends \yii\base\Object implements \yii\web\IdentityInterface, \yii\filters\RateLimitInterface
{
    public $id;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;
    public $rateLimit;
    public $allowance;
    public $allowanceUpdatedAt;

    private static $users = [
        '100' => [
            'id' => '100',
            'username' => 'admin',
            'password' => 'admin',
            'authKey' => 'test100key',
            'accessToken' => '100-token',
        ],
        '101' => [
            'id' => '101',
            'username' => 'demo',
            'password' => 'demo',
            'authKey' => 'test101key',
            'accessToken' => '101-token',
        ],
    ];


    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        $data = (new Query)
            ->from('user')
            ->select(['id' => 'user_id', 'rateLimit' => 'rate_limit', 'allowance', 'allowanceUpdatedAt' => 'allowance_updated_at'])
            ->where('access_token = :access_token')
            ->addParams([':access_token' => $token])
            ->one();

        if ($data != false ) {
            return new static($data);
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        foreach (self::$users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }

    /**
     * @inheritdoc
     */
    public function getRateLimit($request, $action)
    {
        return [$this->rateLimit, 1];
    }

    /**
     * @inheritdoc
     */
    public function loadAllowance($request, $action)
    {
        return [$this->allowance, $this->allowanceUpdatedAt];
    }

    /**
     * @inheritdoc
     */
    public function saveAllowance($request, $action, $allowance, $timestamp)
    {
        Yii::$app->db->createCommand()->update('user', [
            'allowance' => $allowance,
            'allowance_updated_at' => $timestamp
        ], 'user_id = '.$this->id)->execute();
    }
}
