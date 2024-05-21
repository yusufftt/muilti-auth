<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'create-role',
            'edit-role',
            'delete-role',
            'create-user',
            'edit-user',
            'delete-user',
            'create-product',
            'edit-product',
            'delete-product',

            //mengikuti tugas spatie
            'create-mahasiswa',
            'edit-mahasiswa',
            'delete-mahasiswa',
            'show-mahasiswa',

            //mengikuti tugas Admin LTE
            'show-permission',
            'create-permission',
            'edit-permission',
            'delete-permission'
        ];
        //looping and inserting Array's Permissions
        foreach($permissions as $permission){
            Permission::create(['name' => $permission]);
        }
    }
}

