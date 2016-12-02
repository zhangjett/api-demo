<?php

namespace app\modules\v1\controllers;

use Yii;
use yii\rest\Controller;
use app\modules\v1\models\Area;
use yii\web\BadRequestHttpException;
use yii\web\ServerErrorHttpException;
use yii\helpers\Json;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use yii\web\UnprocessableEntityHttpException;
use yii\filters\auth\HttpBearerAuth;
use yii\helpers\ArrayHelper;
use yii\filters\Cors;
use yii\db\Query;

class AreaController extends Controller
{
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::className(),
        ];

        return ArrayHelper::merge(
            [['class' => Cors::className(),],], $behaviors);
    }

    public function actionIndex()
    {
        $condition = Yii::$app->request->get();

        unset($condition['page'], $condition['per-page']);

        $query = (new Query())
            ->select(['area_id', 'area_name', 'parent_id', 'area_type', 'status'])
            ->from('area')
            ->where($condition);

        return new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes' => [
                    'area_id',
                ],
                'defaultOrder' => [
                    'area_id' => SORT_DESC,
                ]
            ],
        ]);

    }

    /**
     * @api {get} /visits/:id 获取访问详情
     * @apiName get-visit
     * @apiGroup property
     * @apiVersion 1.0.0
     *
     * @apiParam (获取用户) {String} id 访问ID.
     *
     * @apiSuccess (创建二维码_response) {Number} visit_id 访问ID.
     * @apiSuccess (创建二维码_response) {String} house_id  小区.
     * @apiSuccess (创建二维码_response) {String} phone  来访手机号.
     * @apiSuccess (创建二维码_response) {String} name 访客姓名.
     * @apiSuccess (创建二维码_response) {String} number  人数.
     * @apiSuccess (创建二维码_response) {String} license_plate  车牌号.
     * @apiSuccess (创建二维码_response) {String} begin_time  有效期开始时间.
     * @apiSuccess (创建二维码_response) {String} end_time  有效期结束时间.
     * @apiSuccess (创建二维码_response) {String} create_time  创建时间.
     * @apiSuccess (创建二维码_response) {String} update_time  修改时间.
     *
     */
    /**
     * @apiDefine property
     *
     * 物业
     */

    public function actionView($id)
    {
        $model = new Area([
            'scenario' => 'view',
        ]);

        $condition = [
            'area_id' => $id
        ];

        $data = $model::find()
            ->select(['area_id', 'area_name', 'parent_id', 'area_type', 'status'])
            ->where($condition)
            ->asArray()
            ->one();

        return $data ;
    }

    /**
     * @api {post} /visits 创建二维码
     * @apiName create-user
     * @apiGroup property
     * @apiVersion 1.0.0
     *
     * @apiParam (创建二维码) {Number} house_id 小区ID.
     * @apiParam (创建二维码) {String} phone 来访手机号.
     * @apiParam (创建二维码) {String} name 访客姓名.
     * @apiParam (创建二维码) {Number} number 人数.
     * @apiParam (创建二维码) {String} [license_plate=''] 车牌.
     * @apiParam (创建二维码) {String} begin_time 有效开始时间.
     * @apiParam (创建二维码) {String} end_time 有效结束时间.
     *
     * @apiSuccess (创建二维码_response) {String} house_id  小区ID.
     * @apiSuccess (创建二维码_response) {String} phone 来访手机号.
     * @apiSuccess (创建二维码_response) {String} name 访客姓名.
     * @apiSuccess (创建二维码_response) {String} number 人数.
     * @apiSuccess (创建二维码_response) {String} license_plate 车牌.
     * @apiSuccess (创建二维码_response) {String} begin_time   有效开始时间.
     * @apiSuccess (创建二维码_response) {String} end_time  有效结束时间.
     * @apiSuccess (创建二维码_response) {String} create_time  创建时间.
     * @apiSuccess (创建二维码_response) {String} update_time  修改时间.
     * @apiSuccess (创建二维码_response) {Number} visit_id 来访ID.
     *
     */
    /**
     * @apiDefine property
     *
     * 物业
     */

    public function actionCreate()
    {
        $model = new Area([
            'scenario' => 'create',
        ]);

        $model->load(Yii::$app->getRequest()->getBodyParams(), '');
        $model->validate();
        if ($model->hasErrors()) {
            throw new BadRequestHttpException(Json::encode($model->errors));
        }

        if (!$model->save(false)) {
            throw new ServerErrorHttpException('Failed to save the object for unknown reason.');
        }

        return $model;
    }

    /**
     * @api {put} /users/:id 修改二维码信息
     * @apiName update-user
     * @apiGroup user
     * @apiVersion 1.0.0
     *
     * @apiParam (修改密码) {Number} id 用户ID.
     * @apiParam (修改密码) {String} scenario 场景,此处值=updatePassword.
     * @apiParam (修改密码) {String} phone 手机号.
     * @apiParam (修改密码) {String} password 密码.
     *
     * @apiSuccess (修改密码_response) {Number} user_id 用户ID.
     * @apiSuccess (修改密码_response) {String} access_token  token.
     * @apiSuccess (修改密码_response) {String} password  密码.
     *
     */
    /**
     * @apiDefine 区域
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

        $model = Area::findOne($id);

        if ($model == false) {
            throw new NotFoundHttpException('资源不存在.');
        }

        $model->setScenario($scenario);
        $model->load(Yii::$app->getRequest()->getBodyParams(), '');
        $model->validate();

        if ($model->hasErrors()) {
            throw new BadRequestHttpException(Json::encode($model->errors));
        }

        if ($model->update(false) === false && !$model->hasErrors()) {
            throw new ServerErrorHttpException('Failed to update the object for unknown reason.');
        }

        return $model;
    }
}
