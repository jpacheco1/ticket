<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::create([
                'name' => 'Administrador',
                'email' => 'admin@ticket.fecp.me',
                'password' => Hash::make('Admin@123*'),
                'active' => 1,
                'district_id' => 36
            ]);
    }
}
