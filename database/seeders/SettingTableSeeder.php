<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pengaturan')->insert([
            'id_pengaturan' => 1,
            'nama_perusahaan'=>'Laravel Store',
            'alamat'=>'Jl. Pahlawan No. 1, Jakarta',
            'telepon'=>'081234567890',
            'tipe_nota'=>1,
            'diskon'=>10,
        ]);
    }
}
