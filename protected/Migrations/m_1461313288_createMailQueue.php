<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1461313288_createMailQueue
    extends Migration
{

    public function up()
    {
        $this->createTable('mail_queue', [
            '__user_id' => ['type' => 'link'],
            'template'  => ['type' => 'string'],
            'content'   => ['type' => 'text'],
            'status'    => ['type' => 'int'],
        ], [
            'status' => ['columns' => ['status']],
        ]);
    }

    public function down()
    {
        $this->dropTable('mail_queue');
    }

}