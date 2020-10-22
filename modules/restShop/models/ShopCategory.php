<?php

namespace app\modules\restShop\models;

use Yii;
use yii\db\Exception;
use yii\db\StaleObjectException;

/**
 * This is the model class for table "shop_category".
 *
 * @property int $category_id
 * @property string $name
 *
 * @property ShopProductCategory[] $shopProductCategories
 * @property ShopProduct[] $products
 */
class ShopCategory extends \yii\db\ActiveRecord
{
  /**
   * {@inheritdoc}
   */
  public static function tableName()
  {
    return 'shop_category';
  }

  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      [['name'], 'required'],
      [['name'], 'string', 'max' => 255],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function attributeLabels()
  {
    return [
      'category_id' => 'Category ID',
      'name' => 'Name',
    ];
  }

  /**
   * Gets query for [[ShopProductCategories]].
   *
   * @return \yii\db\ActiveQuery|ShopProductCategoryQuery
   */
  public function getShopProductCategories()
  {
    return $this->hasMany(ShopProductCategory::className(), ['category_id' => 'category_id']);
  }

  /**
   * Gets query for [[Products]].
   *
   * @return \yii\db\ActiveQuery|ShopProductQuery
   */
  public function getProducts()
  {
    return $this->hasMany(ShopProduct::className(), ['product_id' => 'product_id'])->viaTable('shop_product_category', ['category_id' => 'category_id']);
  }

  /**
   * {@inheritdoc}
   * @return ShopCategoryQuery the active query used by this AR class.
   */
  public static function find()
  {
    return new ShopCategoryQuery(get_called_class());
  }

  /**
   * @return false|int
   * @throws Exception
   * @throws \Throwable
   */
  public function delete()
  {
    try {
      return parent::delete();
    } catch (\Throwable $e) {
      if ($e->getCode() === '23000' && strpos($e->getMessage(), 'foreign key constraint fails')) {
        return 417;
      }
      throw $e;
    }
  }




}
