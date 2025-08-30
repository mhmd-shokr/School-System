<?php

namespace Database\Seeders;

use App\Models\typeBlood;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeBloodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('type_bloods')->delete();
        $types=['O+','O-','A+','A-','B+','B-','AB-','AB+'];

        foreach($types as $type){
            typeBlood::create(["Name"=>$type]);
        }
    }
}
