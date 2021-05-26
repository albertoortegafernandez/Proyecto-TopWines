<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Wine;

class WineSeeder extends Seeder
{
    public function run()
    {
        Wine::create([
            'name'=>'Campo Viejo Tempranillo',
            'origin'=>'Rioja',
            'category'=>'Tinto',
            'type'=>'Tempranillo',
            'price'=>'3.5',
            'description'=>'',
            'image'=>'campViejoTemp.png',
            'user_id'=>1,
        ]);
        
    }
}
