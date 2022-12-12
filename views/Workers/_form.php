<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Workers $model */
/** @var array $evaluators */
/** @var yii\widgets\ActiveForm $form */


?>

<div class="workers-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'identification_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'position')->textInput(['maxlength' => true]) ?>

    <div class="form-group field-workers-evaluator has-success pt-3 pb-3">
        <label>
            <?= Yii::t('app', 'Evaluator') ?> &nbsp;
            <input type="checkbox" id="workers-evaluator" class="form-check-inline" name="Workers[evaluator]" onchange="checkChange();" value="1" >
            <input type="hidden" id="worker-hidden-evaluator" name="Workers[evaluator]" value="0">
        </label>
        <div class="help-block"></div>
    </div>


    <div class="form-group field-workers-evaluator_id has-success">
        <label class="control-label" for="workers-evaluator_id"><?= Yii::t('app', 'Evaluator ID') ?></label>
        <select class="form-select form-select-lg mb-3" name="Workers[evaluator_id]" id="workers-evaluator_id"" aria-invalid="false">
            <option value="X"><?= Yii::t('app', 'Hire an evaluator...' ) ?></option>
            <?php
                foreach ($evaluators as $evaluator) {
                    echo '<option value="' . $evaluator['id'] . '"' . (($evaluator['id'] === $model->evaluator_id) ? ' selected' : '') . '>' . $evaluator['name'] . '</option>';
                }
            ?>
        </select>

        <div class="help-block"></div>
    </div>

    <div class="form-group mt-4">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <script>
        function checkChange() {
            let val = (document.getElementById('workers-evaluator').checked) ? 1 : 0;
            $('#worker-hidden-evaluator').val(val);
        }
    </script>
</div>
