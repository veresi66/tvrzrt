<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\kpi $model */

$this->title = Yii::t('app', 'Create KPI');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'KPIs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kpi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
