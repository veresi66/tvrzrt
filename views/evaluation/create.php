<?php

use app\models\Kpi;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Evaluation $model */
/** @var app\models\Workers $workers */

$this->title                   = Yii::t('app', 'Create Evaluation');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Evaluations'), 'url' => ['create']];
$this->params['breadcrumbs'][] = $this->title;

$kpis = Kpi::find()->all();
$kpiSelect = '<option value="X">' . Yii::t('app', 'Please select ...') . '</option>';
foreach ($kpis as $kpi) {
    $kpiArray[$kpi->id] = $kpi->kpi;
    $kpiSelect .= '<option value="' . $kpi->id . '">' . $kpi->kpi . '</option>';
}
?>
<div class="evaluation-create">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <div id="message-info" class="alert alert-info"><?= Yii::t('app', 'Choose the employee you want to evaluate!') ?></div>
    <div id="message-error" class="alert alert-danger d-none"></div>
    
    <?php $form = ActiveForm::begin(); ?>
    
    <div class="row form-group" id="select-row">
        <label for="worker-select" class="form-label"><?= Yii::t('app', 'Employee to be evaluated') ?></label>
        <select name="worker-select" id="worker-select" class="form-select form-select-lg mb-3" onchange="hideSelect()">
            <option value="0"><?= Yii::t('app', 'Hire a workers ...') ?></option>
            <?php
                foreach ($workers as $worker) {
                    if ($worker['evaluator_id']) {
                        echo '<option value="' . $worker['id'] . '">' . $worker['name'] . '</option>';
                    }
                }
            ?>
        </select>
        <input type="hidden" id="worker_id" name="worker_id">
    </div>

    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <?= Yii::t('app', 'KPIs') ?>
            </div>
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th style="width: 50px">#</th>
                    <th><?= Yii::t('app', 'KPI') ?></th>
                    <th><?= Yii::t('app', 'Priority') ?></th>
                    <th><?= Yii::t('app', 'Result') ?></th>
                    <th class="action-column" style="width: 50px">&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                <tr id="null-row">
                    <td colspan="5">
                        <div class="empty">Nincs találat.</div>
                    </td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="5">
                        <?= Html::button('<i class="fa fa-plus"></i> ' . Yii::t('app', 'Add KPI'), ['class' => 'btn btn-success', 'onclick' => 'addKpi(1)', 'id' => 'addButton']) ?>
                    </th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>


    <div class="form-group pt-4">
        <?= Html::submitButton('<i class="fa fa-save"></i> ' .Yii::t('app', 'Save'), ['class' => 'btn btn-success', 'id' => 'btnSave']) ?>
    </div>
    
    <?php ActiveForm::end(); ?>

    <script>
        var trId = 1,
            evaluationNumber = '<?= Yii::t('app', 'Number of evaluations 3 - 10.') ?>',
            highRating = '<?= Yii::t('app', 'Number of high priority tasks outside the interval (20%)') ?>',
            mediumRating = '<?= Yii::t('app', 'Number of medium priority tasks outside the interval (30%)') ?>',
            kpiArray = ['', <?php
                foreach ($kpiArray as $item) {
                    echo "'$item', ";
                }
                ?>];
        
        $(function() {
            $('#btnSave, #addButton').attr('disabled', true).addClass('btn-disabled');
        })
        
        function hideSelect() {
            let select = $('#worker-select'),
                value = select.val(),
                name = $('#worker-select option:selected').text();
            select.remove();
            $('#worker_id').val(value);
            $('#select-row').append('<div class="h2 pl-4">' + name + '</div>');
            $('#addButton').attr('disabled', false).removeClass('btn-disabled');
            $('#message-info').html('<?= Yii::t('app', 'Add new KPI!') ?>');
            $('#message-error').html(evaluationNumber).removeClass('d-none');
        }
        
        function addKpi(id) {
            let prioSelect = '<select class="form-select"  id="prioSelect' + id + '">' +
                    '<option value="X"><?= Yii::t('app', 'Please select ...') ?></option>' +
                    '<option value="1"><?= Yii::t('app', 'Low') ?></option>' +
                    '<option value="2"><?= Yii::t('app', 'Medium') ?></option>' +
                    '<option value="3"><?= Yii::t('app', 'High') ?></option>' +
                    '</select><input type="hidden" id="priority-' + id + '" name="priority[' + id + ']" />',
                kpiSelect = '<select class="form-select"  id="kpiSelect'+id+'"><?= $kpiSelect ?></select><input type="hidden" name="kpi_id[' + id + ']" id="kpi_id-' + id + '" />',
                resultSelect = '<select class="form-select" id="resultSelect' + id + '">' +
                    '<option value="X"><?= Yii::t('app', 'Please select ...') ?></option>' +
                    '<option value="0"><?= Yii::t('app', 'Critical') ?></option>' +
                    '<option value="20"><?= Yii::t('app', 'To be strongly developed') ?></option>' +
                    '<option value="40"><?= Yii::t('app', 'To be developed') ?></option>' +
                    '<option value="60"><?= Yii::t('app', 'Variable') ?></option>' +
                    '<option value="80"><?= Yii::t('app', 'Good') ?></option>' +
                    '<option value="100"><?= Yii::t('app', 'Excellent') ?></option>' +
                    '</select><input type="hidden" id="result-' + id + '" name="result[' + id + ']" />'
            ;

            $('#null-row').remove();
            $('table tbody').append(
                '<tr id="' + id + '"><td>' + id + '</td><td>' + kpiSelect + '</td><td>' + prioSelect + '</td><td>' + resultSelect + '</td><td><button id="save' + id + '" type="button" onclick="saveKpi(' + id + ')" class="btn btn-primary fa fa-save p-2"></button>'
            );
            $('#addButton').attr('disabled', true).addClass('btn-disabled');
        }
        
        function saveKpi(id)
        {
            let kpi = $('#kpiSelect' + id),
                prio = $('#prioSelect' + id),
                res = $('#resultSelect' + id);
            if ((kpi.val() !== 'X') && (prio.val() !== 'X') && (res.val() !== 'X')) {
                $('#kpi_id-' + id).val(kpi.val());
                $('#priority-' + id).val(prio.val());
                $('#result-' + id).val(res.val());
                kpi.after($('#kpiSelect' + id + ' option:selected').text()).remove();
                prio.after($('#prioSelect' + id + ' option:selected').text()).remove();
                res.after($('#resultSelect' + id + ' option:selected').text()).remove();
                $('#save' + id).after('<button type="button" id="delButton' + id + '" class="btn btn-danger fa fa-trash p-2" onclick="deleteKpi(' + id + ')"></button>').remove();
                trId++;
                verifySave();
                $('#addButton').attr('disabled', false).removeClass('btn-disabled').attr('onclick', 'addKpi(' + trId + ')');
            }
        }
        
        function verifySave()
        {
            let highPrio = $('[id^=priority][value=3]').length,
                mediumPrio = $('[id^=priority][value=2]').length,
                allItem = trId - 1,
                highPercent = highPrio / allItem,
                mediumPercent = mediumPrio / allItem,
                messageDiv = $('#message-error'),
                message = evaluationNumber;
            
            if ((trId > 3) && (trId <= 10) && (highPercent <= 0.25) && (mediumPercent <= 0.3)) {
                $('#btnSave').removeClass('btn-disabled').attr('disabled', false);
                messageDiv.removeClass('alert-danger').addClass('alert-success').html(message);
            } else {
                $('#btnSave').addClass('btn-disabled').attr('disabled', true);
                messageDiv.removeClass('alert-success').addClass('alert-danger');
                if (highPercent > 0.25 ) {
                    message += '<br />' + highRating;
                }
                if (mediumPercent > 0.3 ) {
                    message += '<br />' + mediumRating;
                }
                messageDiv.html(message);
            }
        }
        
        function deleteKpi(id) {
            let prioSelect = '<select class="form-select"  id="prioSelect' + id + '">' +
                    '<option value="X"><?= Yii::t('app', 'Please select ...') ?></option>' +
                    '<option value="1"><?= Yii::t('app', 'Low') ?></option>' +
                    '<option value="2"><?= Yii::t('app', 'Medium') ?></option>' +
                    '<option value="3"><?= Yii::t('app', 'High') ?></option>' +
                    '</select><input type="hidden" id="priority[' + id + ']" name="priority[' + id + ']" />',
                kpiSelect = '<select class="form-select"  id="kpiSelect'+id+'"><?= $kpiSelect ?></select><input type="hidden" name="kpi_id[' + id + ']" id="kpi_id[' + id + ']" />',
                resultSelect = '<select class="form-select" id="resultSelect' + id + '">' +
                    '<option value="X"><?= Yii::t('app', 'Please select ...') ?></option>' +
                    '<option value="0"><?= Yii::t('app', 'Critical') ?></option>' +
                    '<option value="20"><?= Yii::t('app', 'To be strongly developed') ?></option>' +
                    '<option value="40"><?= Yii::t('app', 'To be developed') ?></option>' +
                    '<option value="60"><?= Yii::t('app', 'Variable') ?></option>' +
                    '<option value="80"><?= Yii::t('app', 'Good') ?></option>' +
                    '<option value="100"><?= Yii::t('app', 'Excellent') ?></option>' +
                    '</select><input type="hidden" id="result[' + id + ']" name="result[' + id + ']" />',
                trRow = $('tr#' + id)
            ;
            trRow.children('td:nth-child(2)').html(kpiSelect);
            trRow.children('td:nth-child(3)').html(prioSelect);
            trRow.children('td:nth-child(4)').html(resultSelect);
            trRow.children('td:last-child').html('<button id="save' + id + '" type="button" onclick="saveKpi(' + id + ')" class="btn btn-primary fa fa-save p-2"></button>');
        }
        
    </script>
</div>
