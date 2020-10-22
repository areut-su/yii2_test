<?php

namespace app\modules\restShop\controllers;

use yii\rest\ActiveController;
use yii\web\BadRequestHttpException;

abstract class BaseController extends ActiveController
{
  /**
   *  вывод толко в json без учета заголовка.
   */
//  public function beforeAction($action)
//  {
//    $actopn = parent::beforeAction($action);
//    \Yii::$app->response->format = \Yii::$app->response::FORMAT_JSON;
//    return $actopn;
//  }
}
