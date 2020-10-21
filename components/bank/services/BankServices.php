<?php

namespace app\components\bank\services;

use app\components\bank\clients\BankClient;
use app\components\bank\models\Bank;
use app\components\bank\models\MBank;

class BankServices
{
  /**
   * @throws \yii\db\Exception
   * @throws \Exception
   */
  public function run()
  {
    $m = new MBank();
    $c = new BankClient();
    $result = $c->rate();

    $models = MBank::loadValidateMultiple($m, $result['Valute'] ?? []);

    $transaction = \Yii::$app->db->beginTransaction();
    foreach ($models as $m) {
      // можно передлать на пакетную вставку и разбор моделей при загурзке
      \Yii::$app->getDb()->createCommand()->upsert(Bank::tableName(), $m->toArray())->execute();
    }
    $transaction->commit();
  }


}
