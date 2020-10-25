<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class IdentitasDifabel extends Migration
{
	public function up()
	{
			$this->forge->addField([
					'difabel_id'          => [
							'type'           => 'INT',
							'constraint'     => 11,
							'unsigned'       => true,
							'auto_increment' => true,
					],
					'difabel_no_urut'       => [
							'type'           => 'VARCHAR',
							'constraint'     => '255',
          ],
					'difabel_nama'       => [
							'type'           => 'VARCHAR',
							'constraint'     => '255',
					],
					'difabel_nik'       => [
							'type'           => 'CHAR',
							'constraint'     => '16',
          ],
					'difabel_no_kk'       => [
							'type'           => 'CHAR',
							'constraint'     => '16',
          ],
					'difabel_no_dtks'       => [
							'type'           => 'CHAR',
							'constraint'     => '16',
					],
					'difabel_tempat_lahir'       => [
							'type'           => 'VARCHAR',
							'constraint'     => '255',
					],
					'difabel_tanggal_lahir'       => [
							'type'           => 'DATE',
					],
					'difabel_jk'       => [
							'type'           => 'VARCHAR',
							'constraint'     => '255',
					],
					'agama_id'       => [
							'type'           => 'INT',
							'constraint'     => 11,
					],
					'alamat_jalan_perumahan'       => [
							'type'           => 'VARCHAR',
							'constraint'     => '255',
					],
					'alamat_rt'       => [
							'type'           => 'VARCHAR',
							'constraint'     => '255',
					],
					'alamat_rw'       => [
							'type'           => 'VARCHAR',
							'constraint'     => '255',
					],
					'alamat_desa'       => [
							'type'           => 'VARCHAR',
							'constraint'     => '255',
					],
					'alamat_kecamatan'       => [
							'type'           => 'VARCHAR',
							'constraint'     => '255',
					],
					'alamat_kabupaten'       => [
							'type'           => 'VARCHAR',
							'constraint'     => '255',
					],
					'alamat_telepon'       => [
							'type'           => 'VARCHAR',
							'constraint'     => '255',
					],
					'jenis_disabilitas_id'       => [
							'type'           => 'INT',
							'constraint'     => 11,
					],
					'alat_bantu_id'       => [
							'type'           => 'INT',
							'constraint'     => 11,
					],
					'fasilitas_kesehatan_id'       => [
							'type'           => 'INT',
							'constraint'     => 11,
					],
					'keterampilan_id'       => [
							'type'           => 'INT',
							'constraint'     => 11,
					],
					'difabel_keterampilan_lainnya' => [
							'type'           => 'VARCHAR',
							'constraint'     => '255',
							'nullable' 			 => true,
					],
					'organisasi_id'       => [
							'type'           => 'INT',
							'constraint'     => 11,
					],
					'difabel_organisasi_lainnya' => [
							'type'           => 'VARCHAR',
							'constraint'     => '255',
							'nullable' 			 => true,
					],
					'kondisi_orang_tua_id'       => [
							'type'           => 'INT',
							'constraint'     => 11,
					],
					'pekerjaan_id'       => [
							'type'           => 'INT',
							'constraint'     => 11,
					],
					'difabel_pekerjaan_lainnya' => [
							'type'           => 'VARCHAR',
							'constraint'     => '255',
							'nullable' 			 => true,
					],
					'kebutuhan_pelatihan_id'       => [
							'type'           => 'INT',
							'constraint'     => 11,
					],
					'difabel_pelatihan_lainnya' => [
							'type'           => 'VARCHAR',
							'constraint'     => '255',
							'nullable' 			 => true,
					],
					'kebutuhan_perawatan_id'       => [
							'type'           => 'INT',
							'constraint'     => 11,
					],
					'difabel_perawatan_lainnya' => [
							'type'           => 'VARCHAR',
							'constraint'     => '255',
							'nullable' 			 => true,
					],
					'kondisi_difabel_id'       => [
							'type'           => 'INT',
							'constraint'     => 11,
					],
					'difabel_permasalahan' => [
							'type'           => 'TEXT'
					],
					'sudah_verif'       => [
							'type'           => 'INT',
							'constraint'     => 11,
							'default'				 => 0
					],
					'created_at'       => [
							'type'           => 'DATETIME',
							'default' => date('Y-m-d H:i:s')
					],
					'updated_at'       => [
							'type'           => 'DATETIME',
							'default' => date('Y-m-d H:i:s')
					],
					'user_daftar'       => [
							'type'           => 'CHAR',
							'constraint'     => '16',
					],
					'status'       => [
							'type'           => 'INT',
							'constraint'     => 11,
							'default'				 => 0
					],
					'difabel_image'       => [
							'type'           => 'TEXT'
					],
			]);
			$this->forge->addKey('difabel_id', true);
			$this->forge->createTable('identitas_difabel');
	}

	public function down()
	{
			$this->forge->dropTable('identitas_difabel');
	}
}
