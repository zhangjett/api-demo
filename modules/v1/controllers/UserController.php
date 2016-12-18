<?php

namespace app\modules\v1\controllers;

use Yii;
use yii\rest\Controller;
use app\modules\v1\models\User;
use yii\helpers\Json;
use yii\data\ActiveDataProvider;
use yii\db\Query;

use yii\web\NotFoundHttpException;
use yii\web\UnprocessableEntityHttpException;
use yii\web\ServerErrorHttpException;

use yii\helpers\ArrayHelper;
use yii\filters\Cors;

class UserController extends Controller
{
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        return ArrayHelper::merge(
            [['class' => Cors::className(),],], $behaviors);
    }

    /**
     * @api {get} /users 获取用户
     * @apiName get-user
     * @apiGroup user
     * @apiVersion 1.0.0
     *
     * @apiParam (获取区域列表) {String} [page = 1] 页码.
     * @apiParam (获取区域列表) {String} [per-page = 20] 每页数量.
     * @apiParam (获取区域列表) {string="user_id","-user_id"} [sort] 排序字段
     *
     * @apiSuccess (获取用户列表_response) {String} user_id 用户ID.
     * @apiSuccess (获取用户列表_response) {String} phone  手机号.
     * @apiSuccess (获取用户列表_response) {String} password  密码.
     * @apiSuccess (获取用户列表_response) {String} name 用户名.
     * @apiSuccess (获取用户列表_response) {String} nick_name  昵称.
     * @apiSuccess (获取用户列表_response) {String} access_token  access_token.
     *
     */
    /**
     * @apiDefine user
     *
     * 用户
     */

    public function actionIndex()
    {
        $condition = Yii::$app->request->get();

        $query = (new Query())
            ->select(['user_id', 'phone', 'password', 'name', 'nick_name', 'access_token'])
            ->from('user');

            if (is_array($condition) && (count($condition) > 0)) {
                foreach ($condition as $key => $value) {
                    if (in_array($key, ['phone'])) {
                        $query->andWhere($key.' = :key', [':key' => $value]);
                    }
                }
            }

        return new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'enableMultiSort' => true,
                'attributes' => [
                    'user_id'
                ],
            ],
        ]);
    }

    /**
     * @api {get} /users/:id 获取用户详情
     * @apiName get-user-detail
     * @apiGroup user
     * @apiVersion 1.0.0
     *
     * @apiParam (获取用户) {String} id 用户ID.
     *
     * @apiSuccess (获取用户列表_response) {Number} user_id 用户ID.
     * @apiSuccess (获取用户列表_response) {String} phone  手机号.
     * @apiSuccess (获取用户列表_response) {String} password  密码.
     * @apiSuccess (获取用户列表_response) {String} name 用户名.
     * @apiSuccess (获取用户列表_response) {String} nick_name  昵称.
     * @apiSuccess (获取用户列表_response) {String} access_token  access_token.
     *
     */
    /**
     * @apiDefine user
     *
     * 用户
     */

    public function actionView($id)
    {
        $model = new User([
            'scenario' => 'view',
        ]);

        $condition = [
            'user_id' => $id
        ];

        $data = $model::find()
            ->select(['user_id', 'phone', 'password', 'name', 'nick_name', 'access_token'])
            ->where($condition)
            ->one();

        return $data;
    }

    /**
     * @api {post} /users 注册用户
     * @apiName create-user
     * @apiGroup user
     * @apiVersion 1.0.0
     *
     * @apiParam (注册用户) {String} phone 手机号.
     * @apiParam (注册用户) {String} password 密码.
     *
     * @apiSuccess (注册用户_response) {Number} user_id 用户ID.
     * @apiSuccess (注册用户_response) {String} password  密码.
     * @apiSuccess (注册用户_response) {String} phone  手机号.
     * @apiSuccess (注册用户_response) {String} create_time  创建时间.
     * @apiSuccess (注册用户_response) {String} update_time  修改时间.
     * @apiSuccess (注册用户_response) {String} access_token  token.
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
            'scenario' => 'create',
        ]);

        $model->load(Yii::$app->getRequest()->getBodyParams(), '');
        $model->validate();
        if ($model->hasErrors()) {
            throw new UnprocessableEntityHttpException(Json::encode($model->errors));
        }

        if (!$model->save(false)) {
            throw new ServerErrorHttpException('Failed to save the object for unknown reason.');
        }

        return $model;
    }

    /**
     * @api {put} /users/:id 修改用户信息
     * @apiName update-user
     * @apiGroup user
     * @apiVersion 1.0.0
     *
     * @apiParam (修改密码) {Number} id 用户ID.
     * @apiParam (修改密码) {String} scenario 场景,此处值=updatePassword.
     * @apiParam (修改密码) {String} password 密码.
     *
     * @apiSuccess (修改密码_response) {Number} user_id 用户ID.
     * @apiSuccess (修改密码_response) {String} phone  手机号.
     * @apiSuccess (修改密码_response) {String} password  密码.
     * @apiSuccess (修改密码_response) {String} name 用户名.
     * @apiSuccess (修改密码_response) {String} nick_name  昵称.
     * @apiSuccess (修改密码_response) {Number} status  状态.
     * @apiSuccess (修改密码_response) {String} access_token  token.
     * @apiSuccess (修改密码_response) {String} create_time  创建时间.
     * @apiSuccess (修改密码_response) {String} update_time 修改时间.
     *
     */
    /**
     * @apiDefine user
     *
     * 用户
     */

    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $scenario = $request->getBodyParam('scenario');

        if (!$scenario || $id == null) {
            throw new UnprocessableEntityHttpException('参数不全');
        }

        $validationModel = new User([
            'scenario' => $scenario,
        ]);
        $validationModel->load(Yii::$app->getRequest()->getBodyParams(), '');
        $validationModel->validate();

        if ($validationModel->hasErrors()) {
            throw new UnprocessableEntityHttpException(Json::encode($validationModel->errors));
        }

        $model = User::findOne($id);

        if ($model == null) {
            throw new NotFoundHttpException('资源不存在');
        }

        if (array_key_exists('save'.ucfirst($scenario), $model->scenarios())) {
            $model->setScenario('save'.ucfirst($scenario));
            $model->load(Yii::$app->getRequest()->getBodyParams(), '');
            $model->validate();
        } else {
            $model->setScenario($scenario);
            $model->load(Yii::$app->getRequest()->getBodyParams(), '');
        }

        if ($model->update(false) === false && !$model->hasErrors()) {
            throw new ServerErrorHttpException('Failed to update the object for unknown reason.');
        }

        return $model;
    }


    /**
     * @api {delete} /users/:id 删除用户
     * @apiName delete-user
     * @apiGroup user
     * @apiVersion 1.0.0
     *
     * @apiParam (获取用户) {String} id 用户ID.
     *
     * @apiSuccess (修改密码_response) {Number} user_id 用户ID.
     * @apiSuccess (修改密码_response) {String} phone  手机号.
     * @apiSuccess (修改密码_response) {String} password  密码.
     * @apiSuccess (修改密码_response) {String} name 用户名.
     * @apiSuccess (修改密码_response) {String} nick_name  昵称.
     * @apiSuccess (修改密码_response) {Number} status  状态.
     * @apiSuccess (修改密码_response) {String} access_token  token.
     * @apiSuccess (修改密码_response) {String} create_time  创建时间.
     * @apiSuccess (修改密码_response) {String} update_time 修改时间.
     *
     */
    /**
     * @apiDefine user
     *
     * 用户
     */

    public function actionDelete($id)
    {
        if ($id == null) {
            throw new UnprocessableEntityHttpException('参数不全');
        }

        $model = User::findOne($id);

        if ($model->delete() === false) {
            throw new ServerErrorHttpException('Failed to delete the object for unknown reason.');
        }

        return $model;

    }
}
