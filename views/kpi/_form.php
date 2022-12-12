<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\kpi $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="kpi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kpi')->textInput(['maxlength' => true]) ?>

    <div class="form-group mt-4">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
