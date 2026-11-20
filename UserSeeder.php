<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@napfenytours.hu'],
            [
                'name' => 'Napfény Tours admin',
                'password' => 'Napfeny123!',
                'role' => 1,
            ]
        );
    }
}
