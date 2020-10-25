<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LoginUser extends Migration
{
	public function up()
	{
			$this->forge->addField([
					'login_user_id'          => [
							'type'           => 'INT',
							'constraint'     => 11,
							'unsigned'       => true,
							'auto_increment' => true,
					],
					'login_user_nik'       => [
							'type'           => 'VARCHAR',
							'constraint'     => '50',
          ],
          'login_user_waktu'       => [
							'type'           => 'DATETIME',
							'default' => date('Y-m-d H:i:s')
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
			$this->forge->addKey('login_user_id', true);
			$this->forge->createTable('login_user');
	}

	public function down()
	{
			$this->forge->dropTable('login_user');
	}
}
