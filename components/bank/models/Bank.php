<?php

namespace app\components\bank\models;

use common\traits\MultipleTrait;
use Yii;

/**
 * This is the model class for table "bank".
 *
 * @property int $id
 * @property string $name
 * @property float $rate
 * @property string $nominal
 * @property string $char_code
 */
class Bank extends \yii\db\ActiveRecord
{
  use MultipleTrait;

  /**
   * {@inheritdoc}
   */
  public static function tableName()
  {
    return 'bank';
  }

  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      [['name', 'rate', 'nominal', 'char_code', 'id'], 'required'],
      [['rate'], 'number'],
      [['name'], 'string', 'max' => 255],
      [['nominal'], 'string', 'max' => 4],
      [['id'], 'string', 'max' => 3],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function attributeLabels()
  {
    return [
      'id' => 'Char Code',
      'name' => 'Name',
      'rate' => 'Rate',
      'nominal' => 'Nominal',
    ];
  }

  /**
   * {@inheritdoc}
   * @return BankQuery the active query used by this AR class.
   */
  public static function find()
  {
    return new BankQuery(get_called_class());
  }

  public function fields()
  {
    return parent::fields() + ['rate_by_1' => function () {
        return bcdiv($this->rate, $this->nominal, 6);
      }];
  }

}
