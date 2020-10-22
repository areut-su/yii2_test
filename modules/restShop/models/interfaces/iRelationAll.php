<?php


namespace app\modules\restShop\models\interfaces;


use yii\db\Exception;

interface iRelationAll
{

  /**
   * Load all attribute including related attribute
   * @param $POST
   * @param array $skippedRelations
   * @return bool
   */
  public function loadAll($POST, $skippedRelations = []);

  /**
   * Save model including all related model already loaded
   * @param array $skippedRelations
   * @return bool
   * @throws Exception
   */
  public function saveAll($skippedRelations = []);


}