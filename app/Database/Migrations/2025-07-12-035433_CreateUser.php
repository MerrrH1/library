<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUser extends Migration
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
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => false, // Kolom 'name' tidak boleh kosong
            ],
            'username' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'unique'     => true, // 'username' harus unik
                'null'       => false,
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => '255', // Lebih panjang untuk hash password
                'null'       => false,
            ],
            'created_at' => [
                'type'       => 'DATETIME',
                'null'       => true, // Bisa kosong, akan diisi otomatis jika useTimestamps aktif
            ],
            'updated_at' => [
                'type'       => 'DATETIME',
                'null'       => true, // Bisa kosong, akan diisi otomatis
            ],
            'deleted_at' => [
                'type'       => 'DATETIME',
                'null'       => true, // Digunakan untuk fitur soft delete
            ],
        ]);

        // Menambahkan 'id' sebagai primary key
        $this->forge->addKey('id', true);

        // Membuat tabel 'users'
        $this->forge->createTable('users');
    }

    public function down()
    {
        // Untuk mengembalikan migrasi (rollback), kita akan menghapus tabel 'users'
        $this->forge->dropTable('users');
    }
}