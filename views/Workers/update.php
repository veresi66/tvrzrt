<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Workers $model */
/** @var array $evaluators */

$this->title = Yii::t('app', 'Update Workers: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Workers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="workers-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'evaluators' => $evaluators
    ]) ?>

</div>
