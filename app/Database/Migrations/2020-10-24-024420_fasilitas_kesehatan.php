<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FasilitasKesehatan extends Migration
{
	public function up()
	{
			$this->forge->addField([
					'fasilitas_kesehatan_id'          => [
							'type'           => 'INT',
							'constraint'     => 11,
							'unsigned'       => true,
							'auto_increment' => true,
					],
					'fasilitas_kesehatan_nama'       => [
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
			$this->forge->addKey('fasilitas_kesehatan_id', true);
			$this->forge->createTable('fasilitas_kesehatan');
	}

	public function down()
	{
			$this->forge->dropTable('fasilitas_kesehatan');
	}
}
