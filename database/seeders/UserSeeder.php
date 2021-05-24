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
            'adress'=>'topwines ',
            'postal_code'=>0,
            'city'=>' ',
            'phone_number'=>0,
            'email'=>'admin@admin.es',
            'password'=>bcrypt('admin'),
            'avatar'=>'admin.png',
        ]);
        User::create([
            'role'=>'sumiller',
            'name'=>'sumiller',
            'surname'=>' ',
            'nick'=>'sumiller',
            'adress'=>'topwines ',
            'postal_code'=>00,
            'city'=>' ',
            'phone_number'=>01,
            'email'=>'sumiller@topwines.es',
            'password'=>bcrypt('sumiller'),
            'avatar'=>'sumiller.jpg',
        ]);
        User::create([
            'name'=>'Jose',
            'surname'=>'Gonzalez Martinez ',
            'nick'=>'josete',
            'adress'=>'C/ Zaragoza nº2 4ºA',
            'postal_code'=>'50001',
            'city'=>'Zaragoza',
            'phone_number'=>650235478,
            'email'=>'josezgz@gmail.com',
            'password'=>bcrypt('jose'),
            'avatar'=>'joseGonz.png',
        ]);
        User::create([
            'name'=>'Francisco',
            'surname'=>'Rodriguez Martinez ',
            'nick'=>'Paco',
            'adress'=>'C/ Palma nº2 4ºA',
            'postal_code'=>'20004',
            'city'=>'Murcia',
            'phone_number'=>650565478,
            'email'=>'paco@gmail.com',
            'password'=>bcrypt('paco'),
            'avatar'=>'pacoRodri.jpg',
        ]);
        User::create([
            'name'=>'Maria',
            'surname'=>'Garcia Fernandez ',
            'nick'=>'Mery',
            'adress'=>'Av Pirineos nº2 4ºA',
            'postal_code'=>'00004',
            'city'=>'Teruel',
            'phone_number'=>670565978,
            'email'=>'maria@gmail.com',
            'password'=>bcrypt('maria'),
            'avatar'=>'mariaGarci.png',
        ]);
    }
}
