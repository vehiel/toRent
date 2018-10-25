<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tr12det_alq".
 *
 * @property int $idd_12in Id Detalle
 * @property int $ido_11in Id Orden
 * @property int $chr_10in Código de Herramienta
 * @property string $pre_12de Precio
 * @property int $can_12in Cantidad
 * @property string $mto_12de Monto Total
 *
 * @property Tr10her $chr10in
 * @property Tr11ordAlq $o11in
 */
class Tr12detalq extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tr12det_alq';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ido_11in', 'chr_10in', 'pre_12de', 'can_12in', 'mto_12de'], 'required'],
            [['ido_11in', 'chr_10in', 'can_12in'], 'integer'],
            [['pre_12de', 'mto_12de'], 'number'],
            [['chr_10in'], 'exist', 'skipOnError' => true, 'targetClass' => Tr10her::className(), 'targetAttribute' => ['chr_10in' => 'chr_10in']],
            [['ido_11in'], 'exist', 'skipOnError' => true, 'targetClass' => Tr11ordAlq::className(), 'targetAttribute' => ['ido_11in' => 'ido_11in']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idd_12in' => Yii::t('app', 'Id Detalle'),
            'ido_11in' => Yii::t('app', 'Id Orden'),
            'chr_10in' => Yii::t('app', 'Código de Herramienta'),
            'pre_12de' => Yii::t('app', 'Precio'),
            'can_12in' => Yii::t('app', 'Cantidad'),
            'mto_12de' => Yii::t('app', 'Monto Total'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChr10in()
    {
        return $this->hasOne(Tr10her::className(), ['chr_10in' => 'chr_10in']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getO11in()
    {
        return $this->hasOne(Tr11ordAlq::className(), ['ido_11in' => 'ido_11in']);
    }
}
