<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        Role::insert([
            ['id' => 1, 'name' => 'user'],
            ['id' => 2, 'name' => 'moderator'],
            ['id' => 3, 'name' => 'admin'],
        ]);
    }
}