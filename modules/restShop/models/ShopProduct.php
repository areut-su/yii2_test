<?php

namespace app\modules\restShop\models;

use Yii;

/**
 * This is the model class for table "shop_product".
 *
 * @property int $product_id
 * @property string $name
 * @property int|null $isdeleted
 * @property int|null $published
 * @property int|null $deleted_at
 * @property float|null $price
 *
 * @property ShopProductCategory[] $shopProductCategories
 * @property ShopCategory[] $categories
 */
class ShopProduct extends \yii\db\ActiveRecord
{

  /**
   * {@inheritdoc}
   */
  public static function tableName()
  {
    return 'shop_product';
  }

  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      [['name'], 'required'],
      [['isdeleted', 'published', 'deleted_at'], 'integer'],
      [['price'], 'common\validators\ValidateAmount', 'enableNegative' => false],
      [['name'], 'string', 'max' => 255],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function attributeLabels()
  {
    return [
      'product_id' => 'Product ID',
      'name' => 'Name',
      'isdeleted' => 'Isdeleted',
      'published' => 'Published',
      'deleted_at' => 'Deleted At',
      'price' => 'Price',
    ];
  }

  /**
   * Gets query for [[ShopProductCategories]].
   *
   * @return \yii\db\ActiveQuery|ShopProductCategoryQuery
   */
  public function getShopProductCategories()
  {
    return $this->hasMany(ShopProductCategory::class, ['product_id' => 'product_id'])->indexBy('category_id');
  }

  /**
   * Gets query for [[Categories]].
   *
   * @return \yii\db\ActiveQuery|ShopCategoryQuery
   */
  public function getCategories()
  {
    return $this->hasMany(ShopCategory::class, ['category_id' => 'category_id'])->viaTable('shop_product_category', ['product_id' => 'product_id']);
  }

  /**
   * {@inheritdoc}
   * @return ShopProductQuery the active query used by this AR class.
   */
  public static function find()
  {
    return new ShopProductQuery(get_called_class());
  }


  public function fields()
  {
    return parent::fields() + ['categories']; // раз добавляем то и показываем
  }

  public function extraFields()
  {
    return parent::extraFields();
  }


}
