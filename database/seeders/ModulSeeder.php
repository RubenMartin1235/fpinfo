<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Modul;
use App\Models\User;

class ModulSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tch1 = User::where('name', 'tch1')->first();
        $tch2 = User::where('name', 'tch2')->first();

        $modul = Modul::factory()->create([
            'name' => 'Sistemes Informàtics',
            'shortname' => 'M01',
            'prof_id' => $tch1->id,
        ]);
        $modul = Modul::factory()->create([
            'name' => 'Bases de Dades',
            'shortname' => 'M02',
            'prof_id' => $tch2->id,
        ]);
        $modul = Modul::factory()->create([
            'name' => 'Programació',
            'shortname' => 'M03',
            'prof_id' => $tch1->id,
        ]);
    }
}
