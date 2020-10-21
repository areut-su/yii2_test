<?php

use yii\db\Migration;

/**
 * Class m201021_054222_bank
 */
class m201021_054222_bank extends Migration
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
    $this->createTable('{{%bank}}', [
      'id' => $this->primaryKey(),
      'name' => $this->string(255)->notNull(),
      'rate' => $this->decimal(6, 4)->notNull(),
      'nominal' => $this->string(4)->notNull(),
      'char_code' => $this->char(3)->notNull(),
    ], $tableOptions);

  }


  /**
   * {@inheritdoc}
   */
  public function safeDown()
  {
    echo "m201021_054222_bank cannot be reverted.\n";
    $this->dropTable('{{%bank}}');

    return true;
  }

  /*
  // Use up()/down() to run migration code without a transaction.
  public function up()
  {

  }

  public function down()
  {
      echo "m201021_054222_bank cannot be reverted.\n";

      return false;
  }
  */
}
