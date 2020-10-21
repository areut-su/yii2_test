<?php
/**
 * Created by PhpStorm.
 * User: nikitaignatenkov
 * Date: 11/09/2018
 * Time: 22:44
 */

namespace console\controllers;

namespace app\commands;

use yii\base\InvalidRouteException;
use yii\console\Controller;

abstract class BaseLogController extends Controller
{
  const CONSOLE = 'console';

  public function runAction($id, $params = [])
  {
    try {
      $result = parent::runAction($id, $params);
      \Yii::info($this->id . '/' . $id, self::CONSOLE);
      return $result;
    } catch (InvalidRouteException $e) {
      throw $e;
    } catch (\Throwable $e) {
      \Yii::error($this->id . '/' . $id, self::CONSOLE);
      throw $e;
    }


  }

}