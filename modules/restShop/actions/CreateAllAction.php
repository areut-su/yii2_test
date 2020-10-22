<?php

namespace app\modules\restShop\actions;

use app\modules\restShop\models\interfaces\iRelationAll;
use Yii;
use yii\base\Model;
use yii\helpers\Url;
use yii\rest\Action;
use yii\web\ServerErrorHttpException;

class CreateAllAction extends Action
{
  /**
   * @var string the scenario to be assigned to the new model before it is validated and saved.
   */
  public $scenario = Model::SCENARIO_DEFAULT;
  /**
   * @var string the name of the view action. This property is needed to create the URL when the model is successfully created.
   */
  public $viewAction = 'view';


  /**
   * Creates a new model.
   * @return \yii\db\ActiveRecordInterface the model newly created
   * @throws ServerErrorHttpException if there is any error when creating the model
   * @throws \yii\base\InvalidConfigException
   * @throws \yii\db\Exception
   */
  public function run()
  {
    if ($this->checkAccess) {
      call_user_func($this->checkAccess, $this->id);
    }
    /* @var $model \yii\db\ActiveRecord|iRelationAll */
    $model = new $this->modelClass([
      'scenario' => $this->scenario,
    ]);

    $model->loadAll(Yii::$app->getRequest()->getBodyParams(), '');
    if ($model->saveAll()) {
      $response = Yii::$app->getResponse();
      $response->setStatusCode(201);
      $id = implode(',', array_values($model->getPrimaryKey(true)));
      $response->getHeaders()->set('Location', Url::toRoute([$this->viewAction, 'id' => $id], true));
    } elseif (!$model->hasErrors()) {
      throw new ServerErrorHttpException('Failed to create the object for unknown reason.');
    }

    return $model;
  }
}
