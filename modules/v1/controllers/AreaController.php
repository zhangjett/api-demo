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

    /**
     * @api {get} /areas 获取区域列表
     * @apiName get-area
     * @apiGroup area
     * @apiVersion 1.0.0
     *
     * @apiParam (获取区域列表) {String} [area_name = ''] 地区名称.
     * @apiParam (获取区域列表) {String="1", "2", "3"} [area_type = ''] 地区类型.
     * @apiParam (获取区域列表) {String} [page = 1] 页码.
     * @apiParam (获取区域列表) {String} [per-page = 20] 每页数量.
     * @apiParam (获取区域列表) {string="area_id", "-area_id", "area_type", "-area_type"} [sort] 排序字段
     *
     *
     * @apiSuccess (获取区域列表_response) {String} area_id 区域ID.
     * @apiSuccess (获取区域列表_response) {String} area_name  区域名称.
     * @apiSuccess (获取区域列表_response) {String} parent_id  父级ID.
     * @apiSuccess (获取区域列表_response) {String} area_type 区域类型,1-省/自治区/直辖市;2-地区(省下面的地级市);3-县/市(县级市)/区.
     * @apiSuccess (获取区域列表_response) {String} status  状态，1-正常，2-停用.
     *
     */
    /**
     * @apiDefine area
     *
     * 区域
     */

    public function actionIndex()
    {
        $condition = Yii::$app->request->get();

        $query = (new Query())
            ->select(['area_id', 'area_name', 'parent_id', 'area_type', 'status'])
            ->from('area');

            if (is_array($condition) && (count($condition) > 0)) {
                foreach ($condition as $key => $value) {
                    if (in_array($key, ['area_name', 'area_type'])) {
                        if (($key == 'area_type')&&(!in_array($value, ['1', '2', '3']))) {
                            continue;
                        }
                        $query->andWhere($key.' = :key', [':key' => $value]);
                    }
                }
            }

        return new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'enableMultiSort' => true,
                'attributes' => [
                    'area_id',
                    'area_type'
                ],
            ],
        ]);

    }

    /**
     * @api {get} /areas/:id 获取区域详情
     * @apiName get-area-detail
     * @apiGroup area
     * @apiVersion 1.0.0
     *
     * @apiParam (获取区域列表) {String} id 区域ID.
     *
     * @apiSuccess (获取区域列表_response) {String} area_id 区域ID.
     * @apiSuccess (获取区域列表_response) {String} area_name  区域名称.
     * @apiSuccess (获取区域列表_response) {String} parent_id  父级ID.
     * @apiSuccess (获取区域列表_response) {String} area_type 区域类型,1-省/自治区/直辖市;2-地区(省下面的地级市);3-县/市(县级市)/区.
     * @apiSuccess (获取区域列表_response) {String} status  状态，1-正常，2-停用.
     *
     */
    /**
     * @apiDefine area
     *
     * 区域
     */

    public function actionView($id)
    {
        $model = new Area([
            'scenario' => 'view',
        ]);

        $data = $model::find()
            ->select(['area_id', 'area_name', 'parent_id', 'area_type', 'status'])
            ->where('area_id =: area_id', [':area_id' => $id])
            ->asArray()
            ->one();

        return $data ;
    }

    /**
     * @api {post} /areas 创建区域
     * @apiName create-area
     * @apiGroup area
     * @apiVersion 1.0.0
     *
     * @apiParam (创建区域) {String} area_name  区域名称.
     * @apiParam (创建区域) {String} parent_id  父级ID.
     * @apiParam (创建区域) {Number} area_type 区域类型,1-省/自治区/直辖市;2-地区(省下面的地级市);3-县/市(县级市)/区.
     * @apiParam (创建区域) {Number} status  状态，1-正常，2-停用.
     *
     * @apiSuccess (创建区域_response) {Number} area_id 区域ID.
     * @apiSuccess (创建区域_response) {String} area_name  区域名称.
     * @apiSuccess (创建区域_response) {String} parent_id  父级ID.
     * @apiSuccess (创建区域_response) {String} area_type 区域类型,1-省/自治区/直辖市;2-地区(省下面的地级市);3-县/市(县级市)/区.
     * @apiSuccess (创建区域_response) {String} status  状态，1-正常，2-停用.
     *
     */
    /**
     * @apiDefine area
     *
     * 区域
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
     * @api {put} /areas/:id 修改区域
     * @apiName update-area
     * @apiGroup area
     * @apiVersion 1.0.0
     *
     * @apiParam (修改区域名称) {Number} id 用户ID.
     * @apiParam (修改区域名称) {String} scenario 场景,此处值=updateName.
     * @apiParam (修改区域名称) {String} area_name 区域名称.
     *
     * @apiSuccess (修改区域名称_response) {Number} area_id 区域ID.
     * @apiSuccess (修改区域名称_response) {String} area_name  区域名称.
     * @apiSuccess (修改区域名称_response) {Number} parent_id  父级ID.
     * @apiSuccess (修改区域名称_response) {Number} area_type 区域类型,1-省/自治区/直辖市;2-地区(省下面的地级市);3-县/市(县级市)/区.
     * @apiSuccess (修改区域名称_response) {Number} status  状态，1-正常，2-停用.
     *
     * @apiParam (修改区域父级ID) {Number} id 用户ID.
     * @apiParam (修改区域父级ID) {String} scenario 场景,此处值=updateParentId.
     * @apiParam (修改区域父级ID) {String} parent_id 父级ID.
     *
     * @apiSuccess (修改区域父级ID_response) {Number} area_id 区域ID.
     * @apiSuccess (修改区域父级ID_response) {String} area_name  区域名称.
     * @apiSuccess (修改区域父级ID_response) {String} parent_id  父级ID.
     * @apiSuccess (修改区域父级ID_response) {Number} area_type 区域类型,1-省/自治区/直辖市;2-地区(省下面的地级市);3-县/市(县级市)/区.
     * @apiSuccess (修改区域父级ID_response) {Number} status  状态，1-正常，2-停用.
     *
     */
    /**
     * @apiDefine area
     *
     * 区域
     */

    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $scenario = $request->getBodyParam('scenario');

        if (!$scenario || $id == null) {
            throw new UnprocessableEntityHttpException('参数不全');
        }

        $validationModel = new Area([
                'scenario' => $scenario,
        ]);
        $validationModel->load(Yii::$app->getRequest()->getBodyParams(), '');
        $validationModel->validate();

        if ($validationModel->hasErrors()) {
            throw new UnprocessableEntityHttpException(Json::encode($validationModel->errors));
        }

        $model = Area::findOne((int)$id);

        if ($model == null) {
            throw new NotFoundHttpException('资源不存在.');
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
     * @api {delete} /areas/:id 删除区域
     * @apiName delete-area
     * @apiGroup area
     * @apiVersion 1.0.0
     *
     * @apiParam (获取区域列表) {String} id 区域ID.
     *
     * @apiSuccess (获取区域列表_response) {Number} area_id 区域ID.
     * @apiSuccess (获取区域列表_response) {String} area_name  区域名称.
     * @apiSuccess (获取区域列表_response) {Number} parent_id  父级ID.
     * @apiSuccess (获取区域列表_response) {Number} area_type 区域类型,1-省/自治区/直辖市;2-地区(省下面的地级市);3-县/市(县级市)/区.
     * @apiSuccess (获取区域列表_response) {Number} status  状态，1-正常，2-停用.
     *
     */
    /**
     * @apiDefine area
     *
     * 区域
     */


    public function actionDelete($id)
    {
        if ($id == null) {
            throw new UnprocessableEntityHttpException('参数不全');
        }

        $model = Area::findOne($id);

        if ($model->delete() === false) {
            throw new ServerErrorHttpException('Failed to delete the object for unknown reason.');
        }

        return $model;

    }
}
