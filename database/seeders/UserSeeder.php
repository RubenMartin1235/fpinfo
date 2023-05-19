<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Role;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role_admin = Role::where('name', 'admin')->first();
        $role_tch = Role::where('name', 'teacher')->first();
        $role_std = Role::where('name', 'student')->first();

        $user = User::factory()->create([
            'name'=>'admin',
            'email'=>'admin@fpinfo.com',
            'password'=>Hash::make('1234'),
            'role_id' => $role_admin->id,
            'remember_token' => Str::random(10),
        ]);

        $user = User::factory()->create([
            'name'=>'tch1',
            'email'=>'tch1@fpinfo.com',
            'password'=>Hash::make('1234'),
            'role_id' => $role_tch->id,
            'remember_token' => Str::random(10),
        ]);
        $user = User::factory()->create([
            'name'=>'tch2',
            'email'=>'tch2@fpinfo.com',
            'password'=>Hash::make('1234'),
            'role_id' => $role_tch->id,
            'remember_token' => Str::random(10),
        ]);

        $user = User::factory()->create([
            'name'=>'Aitor Tilla',
            'email'=>'a.tilla@fpinfo.com',
            'password'=>Hash::make('1234'),
            'role_id' => $role_std->id,
            'remember_token' => Str::random(10),
        ]);
    }
}
