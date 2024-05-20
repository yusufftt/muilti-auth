<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'Super Admin']);
        $admin = Role::create(['name' => 'Admin']);
        $operator = Role::create(['name' => 'Operator']);

        $admin->givePermissionTo([
            'create-user',
            'edit-user',
            'delete-user',
            'create-product',
            'edit-product',
            'delete-product'
        ]);
        
        $operator->givePermissionTo([
            'create-product',
            'edit-product',
            'delete-product'
        ]);

        //mengikuti tugas
        $admin_baak = Role::create(['name' => 'Admin Baak']);
        $admin_keuangan = Role::create(['name' => 'Admin Keuangan']);
        $mahasiswa = Role::create(['name' => 'Mahasiswa']);

        $admin_baak->givePermissionTo([
            'create-mahasiswa',
            'edit-mahasiswa',
            'delete-mahasiswa',
            'show-mahasiswa'
        ]);

        $admin_keuangan->givePermissionTo([
            'show-mahasiswa'
        ]);

        $mahasiswa->givePermissionTo([
            'edit-mahasiswa',
            'show-mahasiswa'
        ]);

        // AdminLTE
        $admin_lte = Role::create(['name' => 'Admin LTE']);
        $admin_lte->givePermissionTo([
            'show-permission',
            'create-permission',
            'edit-permission',
            'delete-permission'
        ]);
    }
}
