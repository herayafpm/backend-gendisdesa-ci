<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
	public function up()
	{
			$this->forge->addField([
					'user_id'          => [
							'type'           => 'INT',
							'constraint'     => 11,
							'unsigned'       => true,
							'auto_increment' => true,
					],
					'user_nik'       => [
							'type'           => 'VARCHAR',
							'constraint'     => '255',
          ],
          'user_nama'       => [
							'type'           => 'VARCHAR',
							'constraint'     => '255',
					],
					'user_tempat_lahir'       => [
							'type'           => 'VARCHAR',
							'constraint'     => '255',
					],
					'user_tanggal_lahir'       => [
							'type'           => 'DATE'
					],
					'user_jk'       => [
							'type'           => 'VARCHAR',
							'constraint'     => '255',
					],
					'desa'       => [
							'type'           => 'VARCHAR',
							'constraint'     => '255',
					],
					'rt'       => [
							'type'           => 'VARCHAR',
							'constraint'     => '255',
					],
					'rw'       => [
							'type'           => 'VARCHAR',
							'constraint'     => '255',
					],
					'kecamatan'       => [
							'type'           => 'VARCHAR',
							'constraint'     => '255',
					],
					'kabupaten'       => [
							'type'           => 'VARCHAR',
							'constraint'     => '255',
					],
					'provinsi'       => [
							'type'           => 'VARCHAR',
							'constraint'     => '255',
					],
					'user_telepon'       => [
							'type'           => 'VARCHAR',
							'constraint'     => '255',
					],
					'user_password'       => [
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
					'last_login'       => [
							'type'           => 'DATETIME',
							'default' => date('Y-m-d H:i:s')
					],
					'user_status'          => [
							'type'           => 'INT',
							'constraint'     => 11,
					],
					'admin_ubah'       => [
							'type'           => 'VARCHAR',
							'constraint'     => '50',
							'default' 			 => '24680',
					],
					'admin_updated_at'       => [
							'type'           => 'VARCHAR',
							'constraint'     => '50',
							'default' 			 => '24680',
          ],
          'status_verif'          => [
							'type'           => 'INT',
							'constraint'     => 11,
          ],
          'verified_at'       => [
							'type'           => 'DATETIME',
							'default' => date('Y-m-d H:i:s')
          ],
          'verified_by'       => [
							'type'           => 'VARCHAR',
							'constraint'     => '255',
							'default' 			 => '24680',
					],
			]);
			$this->forge->addKey('user_id', true);
			$this->forge->createTable('user');
	}

	public function down()
	{
			$this->forge->dropTable('user');
	}
}
