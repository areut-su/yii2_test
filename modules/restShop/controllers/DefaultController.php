<?php

namespace app\modules\restShop\controllers;

use yii\web\Controller;

/**
 * Default controller for the `rest-shop` module
 */
class DefaultController extends Controller
{
  /**
   * Renders the index view for the module
   * @return string
   */
  public function actionIndex()
  {
    return $this->redirect('/rest-shop/product/index');
  }
}
