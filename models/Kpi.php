<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "kpi".
 *
 * @property int $id
 * @property string $kpi
 *
 * @property Evaluation[] $evaluations
 */
class Kpi extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'kpi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kpi'], 'required'],
            [['kpi'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'kpi' => Yii::t('app', 'KPI'),
        ];
    }

    /**
     * Gets query for [[Evaluations]].
     *
     * @return ActiveQuery
     */
    public function getEvaluations(): ActiveQuery
    {
        return $this->hasMany(Evaluation::class, ['kpi_id' => 'id']);
    }
}
