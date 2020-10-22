<?php

namespace app\modules\restShop\models;

/**
 * This is the ActiveQuery class for [[ShopProduct]].
 *
 * @see ShopProduct
 */
class ShopProductQuery extends \yii\db\ActiveQuery
{
  public function active()
  {
    return $this->andWhere(['isdeleted' => false]);
  }

  /**
   * {@inheritdoc}
   * @return ShopProduct[]|array
   */
  public function all($db = null)
  {
    return parent::all($db);
  }

  /**
   * {@inheritdoc}
   * @return ShopProduct|array|null
   */
  public function one($db = null)
  {
    return parent::one($db);
  }
}
