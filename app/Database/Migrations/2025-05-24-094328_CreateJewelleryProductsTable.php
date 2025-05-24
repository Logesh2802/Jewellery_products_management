<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateJewelleryProductsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'product_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'price' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'null'       => false,
            ],
            'category' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => false,
            ],
            'image' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'created_at' => [
                'type'    => 'TIMESTAMP',
                'null'    => true,
              
            ],
            'updated_at' => [
                'type'    => 'TIMESTAMP',
                'null'    => true,
                
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('jewellery_products');
    }

    public function down()
    {
        $this->forge->dropTable('jewellery_products');
    }
}
