<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateVisits extends Migration
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
            'user_id' => [ // Kolom untuk mengaitkan dengan tabel 'users'
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'           => false,
            ],
            'visit_date' => [
                'type'           => 'DATE', // Hanya tanggal, tanpa waktu
                'null'           => false,
            ],
            'time_in' => [
                'type'           => 'TIME', // Hanya waktu, tanpa tanggal
                'null'           => false,
            ],
            'time_out' => [
                'type'           => 'TIME', // Hanya waktu, tanpa tanggal
                'null'           => true, // Bisa null jika kunjungan belum selesai
            ],
            'created_at' => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
            'updated_at' => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
            'deleted_at' => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
        ]);

        $this->forge->addKey('id', true);

        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('visits');
    }

    public function down()
    {
        $this->forge->dropTable('visits');
    }
}