<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tr11ord_alq".
 *
 * @property int $ido_11in Id Orden
 * @property int $ncl_06in Número Cliente
 * @property string $fso_11dt Fecha Solicitud
 * @property string $fre_11dt Fecha Retiro
 * @property string $fde_11dt Fecha Devolución
 * @property string $sto_11de Subtotal
 * @property string $mto_11de Monto Total
 * @property int $est_11in Estado
 *
 * @property Tr06cli $ncl06in
 * @property Tr12detAlq[] $tr12detAlqs
 */
class Tr11ordAlq extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tr11ord_alq';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ncl_06in', 'fso_11dt', 'sto_11de', 'mto_11de', 'est_11in'], 'required'],
            [['ncl_06in', 'est_11in'], 'integer'],
            [['fso_11dt', 'fre_11dt', 'fde_11dt'], 'safe'],
            [['sto_11de', 'mto_11de'], 'number'],
            [['ncl_06in'], 'exist', 'skipOnError' => true, 'targetClass' => Tr06cli::className(), 'targetAttribute' => ['ncl_06in' => 'ncl_06in']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ido_11in' => Yii::t('app', 'Id Orden'),
            'ncl_06in' => Yii::t('app', 'Número Cliente'),
            'fso_11dt' => Yii::t('app', 'Fecha Solicitud'),
            'fre_11dt' => Yii::t('app', 'Fecha Retiro'),
            'fde_11dt' => Yii::t('app', 'Fecha Devolución'),
            'sto_11de' => Yii::t('app', 'Subtotal'),
            'mto_11de' => Yii::t('app', 'Monto Total'),
            'est_11in' => Yii::t('app', 'Estado'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNcl06in()
    {
        return $this->hasOne(Tr06cli::className(), ['ncl_06in' => 'ncl_06in']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTr12detAlqs()
    {
        return $this->hasMany(Tr12detAlq::className(), ['ido_11in' => 'ido_11in']);
    }
}
