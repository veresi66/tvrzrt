<?php

use app\models\Workers;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var $model */

$this->title                   = Yii::t('app', 'Evaluations');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="evaluation-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <?= Yii::t('app', 'KPIs') ?>
            </div>
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th style="width: 50px">#</th>
                    <th><?= Yii::t('app', 'Worker Name') ?></th>
                    <th><?= Yii::t('app', 'Final Result') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $oldEvaluator = '';
                    $i = 1;
                    foreach ($model as $item) {
                        if ($oldEvaluator !== $item['evaluatorName']) {
                            $i = 1;
                            echo '<tr><th colspan="3" class="h3 text-left pl-4">' . $item['evaluatorName'] . '</th></tr>';
                            $oldEvaluator = $item['evaluatorName'];
                        } else {
                            $i++;
                        }
                        echo '<tr><td>' . $i . '</td><td>' . $item['workerName'] .'</td><td>'. sprintf("%01.2f %%", $item['finalResult'] * 100) . '</td></tr>';
                        
                        
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
