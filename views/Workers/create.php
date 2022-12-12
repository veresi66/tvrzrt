<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Workers $model */
/** @var array $evaluators */

$this->title = Yii::t('app', Yii::t('app','Create Workers'));
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Workers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="workers-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'evaluators' => $evaluators
    ]) ?>

</div>
