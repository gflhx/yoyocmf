<?php

namespace backend\modules\user\controllers;

use common\modules\user\models\User;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Default controller for the `user` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }


    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = 'backend-update';

        $moduleModel = $model->profile;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $moduleModel->load(Yii::$app->request->post());
            $moduleModel->save();

            if ($moduleModel->errors) {

                return $this->render('update', [
                    'model' => $model,
                    'moduleModel' => $moduleModel
                ]);

            } else {
                Yii::$app->session->setFlash('success', "更新成功");
                return $this->goBack();
            }

        } else {

            return $this->render('update', [
                'model' => $model,
                'moduleModel' => $moduleModel
            ]);
        }

    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
