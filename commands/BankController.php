<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use app\components\bank\clients\BankClient;
use app\components\bank\models\Bank;
use app\components\bank\models\MBank;
use app\components\bank\services\BankServices;
use yii\db\Exception;


class BankController extends BaseLogController
{
  /**
   * @throws Exception
   * @throws \Exception
   */
  public function actionUpRate()
  {
    $s = new BankServices();
    try {
      $s->run();
    } catch (Exception $e) {
      \Yii::error(['error update\insert ' . Bank::tableName(), $e->getMessage()]);
      throw $e;
    }
    echo 'insert or update success';
  }


}
