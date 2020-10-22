<?php

use yii\db\Migration;

/**
 * Class m201021_141915_shop_rest
 */
class m201021_141915_shop_rest extends Migration
{
  /**
   * {@inheritdoc}
   */
  public function safeUp()
  {

    $tableOptions = null;
    if ($this->db->driverName === 'mysql') {
      $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
    }
    $this->createTable('{{%shop_product}}', [
      'product_id' => $this->primaryKey(),
      'name' => $this->string(255)->notNull(),
      'isdeleted' => $this->boolean()->defaultValue(0),
      'published' => $this->boolean()->defaultValue(0),
      'deleted_at' => $this->integer(),
      'price' => $this->decimal(12, 2)->notNull(),

    ], $tableOptions);

    $this->createTable('{{%shop_category}}', [
      'category_id' => $this->primaryKey(),
      'name' => $this->string(255)->notNull(),
    ], $tableOptions);

    $this->createTable('{{%shop_product_category}}', [
      'product_id' => $this->integer(),
      'category_id' => $this->integer(),
    ], $tableOptions);

    $this->addPrimaryKey('pk_product_category', '{{%shop_product_category}}', ['product_id', 'category_id']);

    $this->addForeignKey('fk_product_category_product_id',
      '{{%shop_product_category}}', 'product_id',
      '{{%shop_product}}', 'product_id'
    );
    $this->addForeignKey('fk_product_category_category_id',
      '{{%shop_product_category}}', 'category_id',
      '{{%shop_category}}', 'category_id'
    );

  }

  /**
   * {@inheritdoc}
   */
  public function safeDown()
  {
    echo "m201021_141915_shop_rest.\n";
    $this->dropTable('{{%shop_product_category}}');
    $this->dropTable('{{%shop_product}}');
    $this->dropTable('{{%shop_category}}');

    return true;
  }

  /*
  // Use up()/down() to run migration code without a transaction.
  public function up()
  {

  }

  public function down()
  {
      echo "m201021_141915_shop_rest cannot be reverted.\n";

      return false;
  }
  */
}
