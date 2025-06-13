<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddImagePathToBooks extends Migration
{
    public function up()
    {
        $this->forge->addColumn('books', [
            'image_path' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
                'after'      => 'publication_year'
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('books', 'image_path');
    }
} 