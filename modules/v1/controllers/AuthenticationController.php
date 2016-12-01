<?php

namespace app\modules\v1\controllers;

use Yii;
use yii\rest\Controller;
use app\modules\v1\models\User;
use yii\web\BadRequestHttpException;
use yii\helpers\Json;

/**
 * Authentication controller for the `v1` module
 */
class AuthenticationController extends Controller
{
    /**
     * @api {post} /user-authentications 获取token(登录)
     * @apiName get-token
     * @apiGroup user
     * @apiVersion 1.0.0
     *
     * @apiParam (登录) {String} phone 手机号.
     * @apiParam (登录) {String} password 密码.
     *
     * @apiSuccess (登录_response) {String} user_id 用户ID.
     * @apiSuccess (登录_response) {String} access_token  token.
     * @apiSuccess (登录_response) {String} password  密码.
     *
     */
    /**
     * @apiDefine user
     *
     * 用户
     */
    public function actionCreate()
    {
        $model = new User([
            'scenario' => 'login',
        ]);

        $model->load(Yii::$app->getRequest()->getBodyParams(), '');
        $model->validate();
        if ($model->hasErrors()) {
            throw new BadRequestHttpException(Json::encode($model->errors));
        }

        $condition = [
            'phone' => $model->phone,
        ];


        $data = $model::find()->select(['user_id', 'access_token', 'password'])->where($condition)->one();

        if ($data == null || Yii::$app->getSecurity()->validatePassword($model->password, $data->password) == false ) {
            throw new BadRequestHttpException('密码验证失败！');
        }

        return $data;
    }
}
