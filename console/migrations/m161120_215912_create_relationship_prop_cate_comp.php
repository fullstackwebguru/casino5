<?php

use yii\db\Migration;

class m161120_215912_create_relationship_prop_cate_comp extends Migration
{
    public function up()
    {
        $this->addForeignKey('fk-propcomp-category_id-category-id', '{{%property_category}}', 'category_id', '{{%category}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-propcate-company_id-company-id', '{{%property_casino}}', 'company_id', '{{%company}}', 'id', 'CASCADE');
    }

    public function down()
    {
        $this->removeForeignKey('fk-propcomp-category_id-category-id');
        $this->removeaddForeignKey('fk-propcate-company_id-company-id');
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
