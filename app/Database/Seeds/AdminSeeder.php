<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class AdminSeeder extends Seeder
{
    public function run()
    {
         $data = [
            'username'      => 'Admin',
            'email'     => 'admin@example.com',
            'password'  => password_hash('admin123', PASSWORD_DEFAULT),
            'created_at'=> Time::now(),
            'updated_at'=> Time::now(),
        ];

        // Insert into `users` table (you can change table name as needed)
        $this->db->table('users')->insert($data);
    }
}
