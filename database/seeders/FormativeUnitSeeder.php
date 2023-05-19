<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Modul;
use App\Models\FormativeUnit;

class FormativeUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $m1 = Modul::where('shortname', 'M01')->first();
        $m2 = Modul::where('shortname', 'M02')->first();
        $m3 = Modul::where('shortname', 'M03')->first();

        $uf = FormativeUnit::factory()->create([
            'name' => 'Sistemes Operatius',
            'shortname' => 'UF1',
            'modul_id' => $m1->id,
        ]);
        $uf = FormativeUnit::factory()->create([
            'name' => 'Instal·lació de programari específic',
            'shortname' => 'UF2',
            'modul_id' => $m1->id,
        ]);

        $uf = FormativeUnit::factory()->create([
            'name' => 'Models de bases de dades',
            'shortname' => 'UF1',
            'modul_id' => $m2->id,
        ]);
        $uf = FormativeUnit::factory()->create([
            'name' => 'Sistemes gestors de bases de dades relacionals',
            'shortname' => 'UF2',
            'modul_id' => $m2->id,
        ]);

        $uf = FormativeUnit::factory()->create([
            'name' => 'Programació modular',
            'shortname' => 'UF1',
            'modul_id' => $m3->id,
        ]);
    }
}
