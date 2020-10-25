<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class OrangTua extends Migration
{
	public function up()
	{
			$this->forge->addField([
					'orang_tua_id'          => [
							'type'           => 'INT',
							'constraint'     => 11,
							'unsigned'       => true,
							'auto_increment' => true,
					],
					'difabel_no_urut'       => [
							'type'           => 'VARCHAR',
							'constraint'     => '255',
          ],
					'ayah_nama'       => [
							'type'           => 'VARCHAR',
              'constraint'     => '255',
              'default'        => '0'
					],
					'ayah_nik'       => [
							'type'           => 'CHAR',
              'constraint'     => '16',
              'default'        => '0'
          ],
					'ayah_no_kk'       => [
							'type'           => 'CHAR',
              'constraint'     => '16',
              'default'        => '0'
          ],
					'ayah_tempat_lahir'       => [
							'type'           => 'VARCHAR',
              'constraint'     => '255',
              'default'        => '0'
					],
					'ayah_tanggal_lahir'       => [
							'type'           => 'VARCHAR',
              'constraint'     => '255',
              'default'        => '1000-01-01'
					],
					'ayah_jk'       => [
							'type'           => 'VARCHAR',
							'constraint'     => '255',
					],
					'ayah_agama_id'       => [
							'type'           => 'INT',
              'constraint'     => 11,
              'default'        => 0
					],
					'ayah_alamat_jalan_perumahan'       => [
							'type'           => 'VARCHAR',
              'constraint'     => '255',
              'default'        => '0'
					],
					'ayah_alamat_rt'       => [
							'type'           => 'VARCHAR',
              'constraint'     => '255',
              'default'        => '0'
					],
					'ayah_alamat_rw'       => [
							'type'           => 'VARCHAR',
              'constraint'     => '255',
              'default'        => '0'
					],
					'ayah_alamat_desa'       => [
							'type'           => 'VARCHAR',
              'constraint'     => '255',
              'default'        => '0'
					],
					'ayah_alamat_kecamatan'       => [
							'type'           => 'VARCHAR',
              'constraint'     => '255',
              'default'        => '0'
					],
					'ayah_alamat_kabupaten'       => [
							'type'           => 'VARCHAR',
              'constraint'     => '255',
              'default'        => '0'
					],
					'ayah_alamat_telepon'       => [
							'type'           => 'CHAR',
							'constraint'     => '15',
					],
					'ibu_nama'       => [
							'type'           => 'VARCHAR',
              'constraint'     => '255',
              'default'        => '0'
					],
					'ibu_nik'       => [
							'type'           => 'CHAR',
              'constraint'     => '16',
              'default'        => '0'
          ],
					'ibu_no_kk'       => [
							'type'           => 'CHAR',
              'constraint'     => '16',
              'default'        => '0'
          ],
					'ibu_tempat_lahir'       => [
							'type'           => 'VARCHAR',
              'constraint'     => '255',
              'default'        => '0'
					],
					'ibu_tanggal_lahir'       => [
							'type'           => 'VARCHAR',
              'constraint'     => '255',
              'default'        => '1000-01-01'
					],
					'ibu_jk'       => [
							'type'           => 'VARCHAR',
							'constraint'     => '255',
					],
					'ibu_agama_id'       => [
							'type'           => 'INT',
              'constraint'     => 11,
              'default'        => 0
					],
					'ibu_alamat_jalan_perumahan'       => [
							'type'           => 'VARCHAR',
              'constraint'     => '255',
              'default'        => '0'
					],
					'ibu_alamat_rt'       => [
							'type'           => 'VARCHAR',
              'constraint'     => '255',
              'default'        => '0'
					],
					'ibu_alamat_rw'       => [
							'type'           => 'VARCHAR',
              'constraint'     => '255',
              'default'        => '0'
					],
					'ibu_alamat_desa'       => [
							'type'           => 'VARCHAR',
              'constraint'     => '255',
              'default'        => '0'
					],
					'ibu_alamat_kecamatan'       => [
							'type'           => 'VARCHAR',
              'constraint'     => '255',
              'default'        => '0'
					],
					'ibu_alamat_kabupaten'       => [
							'type'           => 'VARCHAR',
              'constraint'     => '255',
              'default'        => '0'
					],
					'ibu_alamat_telepon'       => [
							'type'           => 'CHAR',
							'constraint'     => '15',
					],
					'created_at'       => [
							'type'           => 'DATETIME',
							'default' => date('Y-m-d H:i:s')
					],
					'updated_at'       => [
							'type'           => 'DATETIME',
							'default' => date('Y-m-d H:i:s')
					],
			]);
			$this->forge->addKey('orang_tua_id', true);
			$this->forge->createTable('orang_tua');
	}

	public function down()
	{
			$this->forge->dropTable('orang_tua');
	}
}
