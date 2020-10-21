<?php

namespace app\components\bank\clients;

use yii\helpers\Json;

class BankClient extends BaseClient
{
  protected $baseUri = 'http://www.cbr.ru/';
  const URL_RATE_VAL = 'scripts/XML_daily.asp';

  /**
   * @return array
   * @throws \Exception
   */
  public function rate(): array
  {
    $result = $this->sendGet(self::URL_RATE_VAL);
    $new = simplexml_load_string($result);;
    return Json::decode(Json::encode($new), true);

  }

}
