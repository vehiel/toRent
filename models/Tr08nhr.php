<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tr08nhr".
 *
 * @property int $idn_08in Id nombre herramienta
 * @property string $nom_08vc Nombre
 * @property string $ima_08vc Imagen
 *
 * @property Tr10her[] $tr10hers
 */
class Tr08nhr extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
     public $file; //atributo que se utiliza para cargar el logo

    public static function tableName()
    {
        return 'tr08nhr';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nom_08vc'], 'required'],
            [['nom_08vc'], 'string', 'max' => 50],
            [['ima_08vc'], 'string', 'max' => 100],
            //atributo que se utiliza para cargar el logo
            [['file'],'file','extensions' => 'png, jpg','maxSize' => 2048000, 'tooBig' => 'El peso máximo son 2MB'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idn_08in' => Yii::t('app', 'Id nombre herramienta'),
            'nom_08vc' => Yii::t('app', 'Nombre'),
            'ima_08vc' => Yii::t('app', 'Imágen'),
            'file'=> ii::t('app', 'Imágen'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTr10hers()
    {
        return $this->hasMany(Tr10her::className(), ['idn_08in' => 'idn_08in']);
    }
}
