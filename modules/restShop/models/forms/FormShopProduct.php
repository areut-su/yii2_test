<?php

namespace app\modules\restShop\models\forms;

use app\modules\restShop\models\ShopProduct;
use app\modules\restShop\models\ShopProductCategory;
use common\traits\MultipleTrait;
use mootensai\relation\RelationTrait;
use yii\db\Exception;
use yii\helpers\ArrayHelper;


class FormShopProduct extends ShopProduct
{

  private $subForName = 'shopProductCategories';
  public $validate = 1;

  public function formName()
  {
    return parent::formName();
  }

  public function rules()
  {
    return [
        ['validate', function () {
          $shopProductCategories = $this->shopProductCategories;
          $count = count($shopProductCategories);
          if ($count < 2 || $count > 8) {
            $this->addError('shopProductCategories', 'кол.-во ' . $this->subForName . 'должно быть в приедаоха 2-8');
          }
        }]] +

      parent::rules();
  }

  /**
   * Есть написанный   компонент который сохраняет\ обновляет связи, но что бы его использовать его нужно немного поправить.
   * + пользую mootensai\relation\RelationTrait но в там есть ряд ограничений.
   * @param array $data
   */
  public function loadAll($data)
  {
    $this->load($data, '');
    $result = [];
    $msShopProductCategories = $this->shopProductCategories;
    $dataSPC = $data[$this->subForName] ?? [];
    foreach ($dataSPC as $item) {
      $cat_id = $item['category_id'] ?? null;
      if ($cat_id && isset($msShopProductCategories[$cat_id])) {
        $result[$cat_id] = $msShopProductCategories[$cat_id];
        unset($msShopProductCategories[$cat_id]);
      } else {
        $result[$cat_id] = new ShopProductCategory(['product_id' => $this->product_id, 'category_id' => $cat_id]);
      }
    }
    $this->populateRelation('shopProductCategories', $result);
    $this->populateRelation('shopProductCategories_del', $msShopProductCategories);
  }

  /**
   * @param bool $runValidation
   * @param null $attributeNames
   * @return bool
   * @throws Exception
   */
  public function saveAll($runValidation = true, $attributeNames = null)
  {
    $transaction = \Yii::$app->db->beginTransaction();
    $is_new_record = $this->getIsNewRecord();
    $f = $this->save();
    $msShopProductCategories = $this->shopProductCategories;
    if ($f) {
      $column_del = ArrayHelper::getColumn($this->shopProductCategories_del, function ($element) {
        /**
         * @var
         */
        return $element->getPrimaryKey();
      });
      if (!empty($column_del)) {
        $sub = reset($msShopProductCategories);
        $sub::deleteAll(['in', $sub::primaryKey(), $column_del]);
      }
      foreach ($msShopProductCategories as &$item) {
        if ($is_new_record) {
          $item->product_id = $this->product_id;
        }
        $f_save = true;

        $f = $f && ($f_save = $item->save());
        if (!$f_save) {
          $this->addError($this->subForName, $item->getErrors());
        }
      }
    }
    if ($f) {
      $transaction->commit();
      return true;
    } else {
      $transaction->rollBack();
      return false;
    }
  }


  public function delete()
  {
    $this->isdeleted = true;
    $this->deleted_at = time();
    return $this->save(['isdeleted', 'deleted_at'], false);
  }


}
