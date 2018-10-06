<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tr09mar".
 *
 * @property int $cgm_09in Código de marca
 * @property string $nom_09vc Nombre
 * @property int $est_09in Estado
 *
 * @property Tr10her[] $tr10hers
 */
class Tr09mar extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tr09mar';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nom_09vc', 'est_09in'], 'required'],
            [['est_09in'], 'integer'],
            [['nom_09vc'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cgm_09in' => Yii::t('app', 'Código de marca'),
            'nom_09vc' => Yii::t('app', 'Nombre'),
            'est_09in' => Yii::t('app', 'Estado'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTr10hers()
    {
        return $this->hasMany(Tr10her::className(), ['cgm_09in' => 'cgm_09in']);
    }
}
