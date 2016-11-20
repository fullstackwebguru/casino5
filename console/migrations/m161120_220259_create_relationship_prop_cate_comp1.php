<?php

use yii\db\Migration;

class m161120_220259_create_relationship_prop_cate_comp1 extends Migration
{
    public function up()
    {
        $this->addForeignKey('fk-propcomp-property_id-property-id', '{{%property_category}}', 'property_id', '{{%property}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-propcate-property_id-property-id', '{{%property_casino}}', 'property_id', '{{%property}}', 'id', 'CASCADE');
    }

    public function down()
    {
        $this->removeForeignKey('fk-propcomp-property_id-property-id');
        $this->removeaddForeignKey('fk-propcate-property_id-property-id');
        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
