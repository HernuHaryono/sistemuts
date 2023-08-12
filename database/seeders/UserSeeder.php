<?php

namespace Database\Seeders;

use App\Models\Borangdosen;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // //
        // User::truncate();
        $user = User::create([
            'name' => 'Admin Aplikasi',
            'level' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('12345'),
            'remember_token' => Str::random(60),
        ]);

        Borangdosen::create([
            'user_id' => $user->id,
            'nama' => 'Hernu',
            'keterangan' => 'developer',
            'deadline' => 'deadline'
        ]);
    }
}
