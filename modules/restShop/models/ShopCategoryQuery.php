<?php

namespace app\modules\restShop\models;

/**
 * This is the ActiveQuery class for [[ShopCategory]].
 *
 * @see ShopCategory
 */
class ShopCategoryQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ShopCategory[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ShopCategory|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
