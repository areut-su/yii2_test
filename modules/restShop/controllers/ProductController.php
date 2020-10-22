<?php

namespace app\modules\restShop\controllers;

use app\modules\restShop\models\ShopProduct;

class ProductController extends BaseController
{
  public $modelClass = ShopProduct::class;


  public function actions()
  {

    return
      [
        'index' => [
          'class' => 'app\modules\restShop\actions\IndexAction',
          'modelClass' => $this->modelClass,
          'modelSearch' => 'app\modules\restShop\models\search\SearchShopProduct',

        ],
        'view' => [
          'class' => 'yii\rest\ViewAction',
          'modelClass' => $this->modelClass,
        ],
        'options' => [
          'class' => 'yii\rest\OptionsAction',
        ],
        'create' => [
          'class' => 'app\modules\restShop\actions\CreateAllAction',
          'modelClass' => 'app\modules\restShop\models\forms\FormShopProduct',
          'checkAccess' => [$this, 'checkAccess'],

        ],
        'update' => [
          'class' => 'app\modules\restShop\actions\UpdateAllAction',
          'modelClass' => 'app\modules\restShop\models\forms\FormShopProduct',
          'checkAccess' => [$this, 'checkAccess'],
          'scenario' => $this->updateScenario,
        ],
      ] + parent::actions();
  }


}
