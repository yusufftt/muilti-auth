<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creating Super Admin User
        $superAdmin = User::create([
            'name' => 'Rivo',
            'email' => 'superadmin@roles.id',
            'password' => Hash::make('123456')
        ]);
        $superAdmin->assignRole('Super Admin');
        // Creating Admin User
        $admin = User::create([
            'name' => 'Meri',
            'email' => 'admin@roles.id',
            'password' => Hash::make('123456')
        ]);
        $admin->assignRole('Admin');
        // Creating Product Manager User
        $productManager = User::create([
            'name' => 'Fahri',
            'email' => 'operator@roles.id',
            'password' => Hash::make('123456')
        ]);
        $productManager->assignRole('Operator');

        //mengikuti tugas
        $adminBaak = User::create([
            'name' => "Bakri",
            'email' => 'adminbaak@roles.id',
            'password' => Hash::make('123456')
        ]);
        $adminBaak->assignRole('Admin Baak'); 

        $adminKeuangan = User::create([
            'name' => "Ahmad Keuangan",
            'email' => 'adminkeuangan@roles.id',
            'password' => Hash::make('123456')
        ]);
        $adminKeuangan->assignRole('Admin Keuangan');
        
        $mahasiswa = User::create([
            'name' => "Mahasiswa",
            'email' => 'mahasiswa@roles.id',
            'password' => Hash::make('123456'),
            'type' => 3
        ]);
        $mahasiswa->assignRole('Mahasiswa');

        // tugas AdminLTE
        $admin_lte = User::create([
            'name' => 'AdminLTE',
            'email' => 'adminlte@roles.id',
            'password' => Hash::make('123456'),
            'type' => 4
        ]);
        $admin_lte->assignRole('Admin LTE');
    }
}
