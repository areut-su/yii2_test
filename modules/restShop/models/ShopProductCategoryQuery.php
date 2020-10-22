<?php

namespace app\modules\restShop\models;

/**
 * This is the ActiveQuery class for [[ShopProductCategory]].
 *
 * @see ShopProductCategory
 */
class ShopProductCategoryQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ShopProductCategory[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ShopProductCategory|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
