<?php

namespace common\modules\config\controllers;

use Yii;
use common\modules\config\models\Config;
use yii\web\Controller;
use yii\base\Model;
use yii\caching\TagDependency;
/**
 * DefaultController implements the CRUD actions for Config model.
 */
class DefaultController extends Controller
{
    /**
     * Lists all Config models.
     * @return mixed
     */
    public function actionIndex()
    {
        $groups = Yii::$app->config->get('config_group_list');
        $group = Yii::$app->request->get('group', current(array_keys($groups)));
        $configModels = Config::find()->where(['group' => $group])->orderBy("sort asc,id desc")->all();
        return $this->render('index', [
            'groups' => $groups,
            'group' => $group,
            'configModels' => $configModels
        ]);
    }

    public function actionStore()
    {
        $groups = Yii::$app->config->get('config_group_list');
        $group = Yii::$app->request->get('group', current(array_keys($groups)));
        $configModels = Config::find()->where(['group' => $group])->orderBy("sort asc,id desc")->all();
        if (Model::loadMultiple($configModels, \Yii::$app->request->post()) && Model::validateMultiple($configModels)) {
            foreach ($configModels as $configModel) {
                /* @var $config Config */
                $configModel->save(false);
            }
            TagDependency::invalidate(\Yii::$app->cache,  Yii::$app->config->cacheTag);
            Yii::$app->session->setFlash('success', '保存成功');
            return $this->redirect(['index', 'group' => $group]);
        } else {
            Yii::$app->session->setFlash('error', '保存失败');
            return $this->redirect(['index', 'group' => $group]);
        }
    }


}
