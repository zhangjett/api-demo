<?php

namespace app\modules\v1\models;

use Yii;

/**
 * This is the model class for table "area".
 *
 * @property integer $area_id
 * @property string $area_name
 * @property integer $parent_id
 * @property integer $area_type
 * @property integer $status
 */
class Area extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'area';
    }

    public function rules()
    {
        return [
            [['area_name', 'parent_id', 'area_type', 'status'], 'required', 'on' => ['create']],
            [['area_name'], 'required', 'on' => ['updateName']],
            [['parent_id'], 'required', 'on' => ['updateParentId']],
            [['parent_id', 'area_type', 'status'], 'integer'],
        ];
    }

    public function scenarios()
    {
        return [
            'create' => ['area_name', 'parent_id', 'area_type', 'status'],
            'updateName' => ['area_name'],
            'updateParentId' => ['parent_id'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'area_id' => '主键ID',
            'area_name' => '区域名称',
            'parent_id' => '父ID',
            'area_type' => '区域类型',
            'status' => '状态'
        ];
    }
}
