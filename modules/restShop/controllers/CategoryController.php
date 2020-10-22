<?php

namespace app\modules\restShop\controllers;

use app\modules\restShop\models\ShopCategory;
use yii\web\ServerErrorHttpException;

class CategoryController extends BaseController
{
  public $modelClass = ShopCategory::class;


  public function actions()
  {
    return
      [
        'delete' => [
          'class' => 'app\modules\restShop\actions\DeleteAction',
          'modelClass' => $this->modelClass,
          'checkAccess' => [$this, 'checkAccess'],
        ],
      ] + parent::actions();
  }


}
