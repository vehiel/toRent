<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tr04pri".
 *
 * @property int $idp_04in Id Privilegio
 * @property string $pri_04vc Privilegio
 * @property string $lis_04vc Menú nav bar
 *
 * @property Tr05usuPri[] $tr05usuPris
 * @property Tr02usu[] $nus02ins
 */
class Tr04pri extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tr04pri';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pri_04vc', 'lis_04vc'], 'required'],
            [['pri_04vc'], 'string', 'max' => 50],
            [['lis_04vc'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idp_04in' => Yii::t('app', 'Id Privilegio'),
            'pri_04vc' => Yii::t('app', 'Privilegio'),
            'lis_04vc' => Yii::t('app', 'Menú nav bar'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTr05usuPris()
    {
        return $this->hasMany(Tr05usuPri::className(), ['idp_04in' => 'idp_04in']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNus02ins()
    {
        return $this->hasMany(Tr02usu::className(), ['nus_02in' => 'nus_02in'])->viaTable('tr05usu_pri', ['idp_04in' => 'idp_04in']);
    }
}
