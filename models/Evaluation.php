<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "evaluation".
 *
 * @property int $id
 * @property int $kpi_id
 * @property int $worker_id
 * @property string $priority
 * @property int $condition
 * @property string|null $result
 *
 * @property Kpi $kpi
 * @property Workers $worker
 */
class Evaluation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'evaluation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kpi_id', 'worker_id', 'priority'], 'required'],
            [['kpi_id', 'worker_id', 'condition'], 'integer'],
            [['priority', 'result'], 'string'],
            [['kpi_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kpi::class, 'targetAttribute' => ['kpi_id' => 'id']],
            [['worker_id'], 'exist', 'skipOnError' => true, 'targetClass' => Workers::class, 'targetAttribute' => ['worker_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'kpi_id' => Yii::t('app', 'Kpi ID'),
            'worker_id' => Yii::t('app', 'Worker ID'),
            'priority' => Yii::t('app', 'Priority'),
            'condition' => Yii::t('app', 'Condition'),
            'result' => Yii::t('app', 'Result'),
        ];
    }

    /**
     * Gets query for [[Kpi]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKpi()
    {
        return $this->hasOne(Kpi::class, ['id' => 'kpi_id']);
    }

    /**
     * Gets query for [[Worker]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWorker()
    {
        return $this->hasOne(Workers::class, ['id' => 'worker_id']);
    }
}
