<?php

use yii\db\Migration;

/**
 * Handles the creation of table `company`.
 */
class m161108_142834_create_company_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%company}}', [
            'id' => $this->primaryKey(11),
            'category_id' => $this->integer(11)->notNull(),
            'title' => $this->string(255)->notNull(),
            'short_description' => $this->string(300)->notNull(),
            'description' => $this->text(),
            'logo_url' => $this->string(255),
            'image_url' => $this->string(255),
            'website_url' => $this->string(500)->notNull(),
            'rating' => $this->double(2)->notNull(),
            'review' => $this->text(),
            'bonus_as_value' => $this->integer(255)->notNull()->defaultValue(0),
            'bonus_offer' => $this->string(255),
            'software' => $this->string(255),
            'type_of_games' => $this->string(255),
            'support' => $this->string(255),
            'currencies' => $this->string(255),
            'languages' => $this->string(255),
            'feature_mobile' => $this->boolean()->notNull()->defaultValue(true),
            'feature_instant_play' => $this->boolean()->notNull()->defaultValue(true),
            'feature_download' => $this->boolean()->notNull()->defaultValue(true),
            'feature_live_casino' => $this->boolean()->notNull()->defaultValue(true),
            'feature_vip_program' => $this->boolean()->notNull()->defaultValue(true),
            'slug' => $this->string(255),
            'meta_description' => $this->string(255),
            'meta_keywords' => $this->string(255),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ],$tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%company}}');
    }
}
