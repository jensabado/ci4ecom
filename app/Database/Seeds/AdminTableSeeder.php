<?php

namespace App\Database\Seeds;

use App\Libraries\Hash;
use CodeIgniter\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('admins')
        ->insert([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@telegmail.com',
            'password' => Hash::make('admin123'),
        ]);
    }
}
