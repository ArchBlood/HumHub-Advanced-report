<?php

use yii\db\Migration;
/**
 * Class m201206_160921_report
 */
class m201206_160921_report extends Migration
{

    public function up(): void
    {
        $this->createTable('report_post', [
            'id' => $this->primaryKey(),
            'reason' => $this->integer()->notNull(),
            'post_id' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->null(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->null()
        ]);

        $this->createTable('report_comment', [
            'id' => $this->primaryKey(),
            'reason' => $this->integer()->notNull(),
            'comment_id' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->null(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->null()
        ]);

        $this->createTable('report_user', [
            'id' => $this->primaryKey(),
            'reason' => $this->integer()->notNull(),
            'reported_user_id' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->null(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->null()
        ]);

        // Why I don't use polymorphic relation ? Because I'm a Symfony addict, not an Yii addict and I don't know
        // how to do that (I tried), feel free to PR me :D
    }

    public function down(): bool
    {
        echo "m201206_160921_report cannot be reverted.\n";

        return false;
    }
}
