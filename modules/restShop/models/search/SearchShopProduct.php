<?php

namespace app\modules\restShop\models\search;

use app\modules\restShop\models\ShopCategory;
use app\modules\restShop\models\ShopProductCategory;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\restShop\models\ShopProduct;

/**
 * SearchShopProduct represents the model behind the search form of `app\modules\restShop\models\ShopProduct`.
 */
class SearchShopProduct extends Model
{
  public $product_name;
  public $category_name;
  public $category_id;
  public $price_min;
  public $price_max;
  public $published;
  public $isdeleted;

  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      [['product_name', 'category_name'], 'string', 'max' => 255],
      [['published', 'isdeleted'], 'integer', 'min' => 0, 'max' => 1],
      [['category_id'], 'integer'],
      [['price_min', 'price_max'], 'common\validators\ValidateAmount', 'enableNegative' => false],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function scenarios()
  {
    // bypass scenarios() implementation in the parent class
    return Model::scenarios();
  }

  /**
   * Creates data provider instance with search query applied
   *
   * @param array $params
   *
   * @return ActiveDataProvider
   */
  public function search($params)
  {
    $query = ShopProduct::find();

    // add conditions that should always apply here

    $dataProvider = new ActiveDataProvider([
      'query' => $query,
    ]);

    $this->load($params, '');


    if (!$this->validate()) {
      $query->where('0=1');

      /**
       * можно выбросить исключение  с ошибками валидации/ но нужно настраивать response
       */
      return $dataProvider;
    }
    $query->joinWith('categories');


    $query->andFilterWhere([
      '<=', 'price', $this->price_max,
    ]);
    $query->andFilterWhere([
      '>=', 'price', $this->price_min,
    ]);


    $query->andFilterWhere([
      ShopProductCategory::tableName() . '.category_id' => $this->category_id,
      'isdeleted' => $this->isdeleted,
      'published' => $this->published,
    ]);

    $query->andFilterWhere(['like', ShopProduct::tableName() . '.name', $this->product_name]);
    $query->andFilterWhere(['like', ShopCategory::tableName() . '.name', $this->category_name]);

    return $dataProvider;
  }
}
