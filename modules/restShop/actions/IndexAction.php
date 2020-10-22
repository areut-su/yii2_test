<?php


namespace app\modules\restShop\actions;

use yii\data\ActiveDataProvider;

class IndexAction extends \yii\rest\IndexAction
{
  /**
   * @var $modelSearch  InterfaceSearch
   */
  public $modelSearch;


  /**
   * @return ActiveDataProvider
   * @throws \yii\base\InvalidConfigException
   */
  protected function prepareDataProvider()
  {
    $m = \Yii::createObject(
      $this->modelSearch
    );

    $requestParams = \Yii::$app->getRequest()->getBodyParams();
    if (empty($requestParams)) {
      $requestParams = \Yii::$app->getRequest()->getQueryParams();
    }
    if (method_exists($m, 'search'))
      return $m->search($requestParams);
  }


}