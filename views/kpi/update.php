<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\kpi $model */

$this->title = Yii::t('app', 'Update Kpi: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Kpis'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id , 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="kpi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
