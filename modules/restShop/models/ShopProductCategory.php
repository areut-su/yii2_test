<?php

namespace app\modules\restShop\models;

use Yii;

/**
 * This is the model class for table "shop_product_category".
 *
 * @property int $product_id
 * @property int $category_id
 *
 * @property ShopCategory $category
 * @property ShopProduct $product
 */
class ShopProductCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shop_product_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'category_id'], 'required'],
            [['product_id', 'category_id'], 'integer'],
            [['product_id', 'category_id'], 'unique', 'targetAttribute' => ['product_id', 'category_id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ShopCategory::className(), 'targetAttribute' => ['category_id' => 'category_id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => ShopProduct::className(), 'targetAttribute' => ['product_id' => 'product_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'product_id' => 'Product ID',
            'category_id' => 'Category ID',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery|ShopCategoryQuery
     */
    public function getCategory()
    {
        return $this->hasOne(ShopCategory::className(), ['category_id' => 'category_id']);
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery|ShopProductQuery
     */
    public function getProduct()
    {
        return $this->hasOne(ShopProduct::className(), ['product_id' => 'product_id']);
    }

    /**
     * {@inheritdoc}
     * @return ShopProductCategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ShopProductCategoryQuery(get_called_class());
    }
}
