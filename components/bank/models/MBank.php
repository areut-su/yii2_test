<?php

namespace app\components\bank\models;

use common\traits\MultipleTrait;
use yii\base\Model;

/**
 * This is the model class for table "bank".
 *
 * @property string $CharCode
 * @property string $Name
 * @property string $Nominal
 * @property string $Value
 */
class MBank extends Model
{
  public $CharCode;
  public $Name;
  public $Nominal;
  public $Value;

  use MultipleTrait;


  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      [['CharCode', 'Nominal', 'Name', 'Value'], 'required'],
      [['CharCode', 'Nominal', 'Name', 'Value'], 'trim'],
      ['CharCode', 'string', 'length' => 3],
      ['Name', 'string', 'max' => 255],
      ['Nominal', 'number'],
      ['Value', 'string'], ['Value', function () {
        $this->Value = str_replace(' ', '', $this->Value);
        $this->Value = str_replace(',', '.', $this->Value);
      }],
      ['Value', 'match', 'pattern' => '/^[\d\s]*\.{0,1}[\d]{0,4}$/'],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function attributeLabels()
  {
    return [
    ];
  }

  public function fields()
  {
    return [
      'id' => 'CharCode',
      'name' => 'Name',
      'rate' => 'Value',
      'nominal' => 'Nominal'
    ];
  }
}
