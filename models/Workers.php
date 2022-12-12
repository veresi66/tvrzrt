<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "workers".
 *
 * @property int $id
 * @property string $name
 * @property string $identification_number
 * @property string $position
 * @property int|null $evaluator_id
 *
 * @property Workers $evaluator
 * @property Users[] $users
 * @property Workers[] $workers
 */
class Workers extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'workers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['name', 'identification_number', 'position'], 'required'],
            [['evaluator_id', 'evaluator'], 'integer'],
            [['name', 'identification_number', 'position'], 'string', 'max' => 255],
            [['evaluator_id'], 'exist', 'skipOnError' => true, 'targetClass' => Workers::class, 'targetAttribute' => ['evaluator_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'identification_number' => Yii::t('app', 'Identification Number'),
            'position' => Yii::t('app', 'Position'),
            'evaluator_id' => Yii::t('app', 'Evaluator ID'),
            'evaluator' => Yii::t('app', 'Evaluator'),
        ];
    }

    /**
     * Gets query for [[Evaluator]].
     *
     * @return ActiveQuery
     */
    public function getEvaluator(): ActiveQuery
    {
        return $this->hasOne(Workers::class, ['id' => 'evaluator_id']);
    }

    /**
     * Gets query for [[Workers]].
     *
     * @return ActiveQuery
     */
    public function getWorkers(): ActiveQuery
    {
        return $this->hasMany(Workers::class, ['evaluator_id' => 'id']);
    }
}
