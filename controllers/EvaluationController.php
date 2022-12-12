<?php

namespace app\controllers;

use app\models\Evaluation;
use app\models\Workers;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * EvaluationController implements the CRUD actions for Evaluation model.
 */
class EvaluationController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class'   => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }
    
    /**
     * Lists all Evaluation models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $allEvaluation = Evaluation::find()->select('evaluation.*, (SELECT evaluator_id FROM workers WHERE id = evaluation.worker_id) as evaluator_id')->orderBy('evaluator_id, worker_id')->all();

        $sumPriority   = $sumResult = $model = [];
        
        foreach ($allEvaluation as $evaluation) {
            $id = $evaluation['worker_id'];
            
            $sumPriority[ $id ] = ($sumPriority[ $id ] ?? 0) + (int) $evaluation['priority'];
            $sumResult[ $id ]   = ($sumResult[ $id ] ?? 0) + ((int) $evaluation['result'] / 100) * (int) $evaluation['priority'];
        }
        
        for ($i = 0; $i < count($sumPriority); $i++) {
            $worker_ids               = array_keys($sumPriority);
            $worker                   = Workers::findOne(['id' => $worker_ids[ $i ]]);
            $model[$i]['workerName']    = $worker->name;
            $model[$i]['evaluatorName'] = Workers::findOne(['id' => $worker->evaluator_id])->name;
            $model[$i]['finalResult']   = $sumResult[ $worker_ids[ $i ] ] / $sumPriority[ $worker_ids[ $i ] ];
        }
        
        return $this->render('index', [
            'model'   => $model,
        ]);
    }
    
    /**
     * Displays a single Evaluation model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView()
    {
        //
    }
    
    /**
     * Creates a new Evaluation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        if ($this->request->isPost) {
            $post      = $this->request->post();
            $countItem = count($post['kpi_id']);
            $kpi_id    = $post['kpi_id'];
            $priority  = $post['priority'];
            $result    = $post['result'];
            
            for ($i = 1; $i <= $countItem; $i++) {
                $model = new Evaluation();
                
                $model->kpi_id    = $kpi_id[ $i ];
                $model->worker_id = $post['worker_id'];
                $model->priority  = $priority[ $i ];
                $model->result    = $result[ $i ];
                
                $model->save();
            }
        }
        
        return $this->render('create', [
            'workers' => Workers::find()->all(),
        ]);
    }
    
    /**
     * Updates an existing Evaluation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        
        return $this->render('update', [
            'model' => $model,
        ]);
    }
    
    /**
     * Finds the Evaluation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Evaluation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Evaluation::findOne(['id' => $id])) !== null) {
            return $model;
        }
        
        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    
    /**
     * Deletes an existing Evaluation model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        
        return $this->redirect(['index']);
    }
}
