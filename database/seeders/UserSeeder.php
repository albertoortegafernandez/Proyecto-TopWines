<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'role'=>'admin',
            'name'=>'administrador',
            'surname'=>' ',
            'nick'=>'admin',
            'address'=>'topwines ',
            'postal_code'=>0,
            'city'=>' ',
            'phone_number'=>0,
            'email'=>'admin@admin.es',
            'password'=>bcrypt('admin'),
            'avatar'=>'admin.png',
        ]);
        User::create([
            'name'=>'Jose',
            'surname'=>'Gonzalez Martinez ',
            'nick'=>'josete',
            'address'=>'C/ Zaragoza nº2 4ºA',
            'postal_code'=>'50001',
            'city'=>'Zaragoza',
            'phone_number'=>650235478,
            'email'=>'josezgz@gmail.com',
            'password'=>bcrypt('jose'),
            'avatar'=>'joseGonz.png',
        ]);
    }
}
