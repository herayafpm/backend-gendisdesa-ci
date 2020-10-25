<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KondisiDifabel extends Migration
{
	public function up()
	{
			$this->forge->addField([
					'kondisi_difabel_id'          => [
							'type'           => 'INT',
							'constraint'     => 11,
							'unsigned'       => true,
							'auto_increment' => true,
					],
					'kondisi_difabel_nama'       => [
							'type'           => 'VARCHAR',
							'constraint'     => '255',
					],
					'created_at'       => [
							'type'           => 'DATETIME',
							'default' => date('Y-m-d H:i:s')
					],
					'updated_at'       => [
							'type'           => 'DATETIME',
							'default' => date('Y-m-d H:i:s')
					],
					'admin_tambah'       => [
							'type'           => 'VARCHAR',
							'constraint'     => '50',
							'default' 			 => '24680',
					],
					'admin_ubah'       => [
							'type'           => 'VARCHAR',
							'constraint'     => '50',
							'default' 			 => '24680',
					],
			]);
			$this->forge->addKey('kondisi_difabel_id', true);
			$this->forge->createTable('kondisi_difabel');
	}

	public function down()
	{
			$this->forge->dropTable('kondisi_difabel');
	}
}
