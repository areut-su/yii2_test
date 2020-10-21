<?php

namespace app\components\bank\controllers;

use app\components\bank\models\Bank;
use Yii;
use yii\filters\AccessControl;
use yii\rest\ActiveController;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class BankController extends ActiveController
{
  public $modelClass = Bank::class;

  /**
   * {@inheritdoc}
   */
  /*public function behaviors()
  {
    return [
      [
        'bearerAuth' => [
          'class' => \yii\filters\auth\HttpBearerAuth::class,
        ],
      ],
    ];
  }*/

  protected function verbs()
  {
    return [
      'currencies' => ['GET'],
      'currency' => ['GET'],
    ];
  }

  public function actions()
  {
    return [
      'currencies' => [
        'class' => 'yii\rest\IndexAction',
        'modelClass' => $this->modelClass,
        'checkAccess' => [$this, 'checkAccess'],
        'dataFilter' => [
          'class' => 'yii\data\ActiveDataFilter',
          'searchModel' => function () {
            return (new \yii\base\DynamicModel(['id' => null, 'name' => null, 'price' => null]))
              ->addRule(['id', 'name'], 'string')
              ->addRule('name', 'trim');
          },
        ],
      ],
      'currency' => [
        'class' => 'yii\rest\ViewAction',
        'modelClass' => $this->modelClass,
        'checkAccess' => [$this, 'checkAccess'],
      ],
      'options' => [
        'class' => 'yii\rest\OptionsAction',
      ],
    ];
  }

  /**
   * @param string $action
   * @param null $model
   * @param array $params
   * @throws ForbiddenHttpException
   */
  public function checkAccess($action, $model = null, $params = [])
  {
    // можно использотва и стандартный фильтр
    $authHeader = \Yii::$app->request->getHeaders()->get('Authorization');
    if ($authHeader !== null && preg_match('/^Bearer\s+(.*?)$/', $authHeader, $matches)) {
      if ($matches[1] !== 'YmFuazpiYW5r') {
        throw  new ForbiddenHttpException('Bearer not correct');
      }
    }

  }


}
