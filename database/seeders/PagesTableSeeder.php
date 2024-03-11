<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('pages')->delete();
        
        \DB::table('pages')->insert(array (
            0 => 
            array (
                'id' => 1,
                'module' => 'users',
                'name_ar' => 'المستخدمين',
                'name_en' => 'Users',
                'key' => 'users',
                'created_at' => '2022-04-09 03:14:05',
                'updated_at' => '2022-04-09 03:23:14',
            ),
            1 => 
            array (
                'id' => 2,
                'module' => 'users',
                'name_ar' => 'انشاء',
                'name_en' => 'Create',
                'key' => 'create-user',
                'created_at' => '2022-04-09 03:14:05',
                'updated_at' => '2022-04-09 03:14:05',
            ),
            2 => 
            array (
                'id' => 3,
                'module' => 'users',
                'name_ar' => 'عرض',
                'name_en' => 'Show',
                'key' => 'show-user',
                'created_at' => '2022-04-09 03:14:05',
                'updated_at' => '2022-04-09 03:14:05',
            ),
            3 => 
            array (
                'id' => 4,
                'module' => 'users',
                'name_ar' => 'تعديل',
                'name_en' => 'Edit',
                'key' => 'edit-user',
                'created_at' => '2022-04-09 03:14:05',
                'updated_at' => '2022-04-09 03:14:05',
            ),
            4 => 
            array (
                'id' => 5,
                'module' => 'users',
                'name_ar' => 'حذف',
                'name_en' => 'Delete',
                'key' => 'delete-user',
                'created_at' => '2022-04-09 03:14:05',
                'updated_at' => '2022-04-09 03:14:05',
            ),
            5 => 
            array (
                'id' => 51,
                'module' => 'pages',
                'name_ar' => 'الصفحات',
                'name_en' => 'Pages',
                'key' => 'pages',
                'created_at' => '2022-04-09 03:14:05',
                'updated_at' => '2022-04-09 03:18:19',
            ),
            6 => 
            array (
                'id' => 52,
                'module' => 'pages',
                'name_ar' => 'انشاء',
                'name_en' => 'Create',
                'key' => 'create-page',
                'created_at' => '2022-04-09 03:14:05',
                'updated_at' => '2022-04-09 03:14:05',
            ),
            7 => 
            array (
                'id' => 53,
                'module' => 'pages',
                'name_ar' => 'عرض',
                'name_en' => 'Show',
                'key' => 'show-page',
                'created_at' => '2022-04-09 03:14:05',
                'updated_at' => '2022-04-09 03:14:05',
            ),
            8 => 
            array (
                'id' => 54,
                'module' => 'pages',
                'name_ar' => 'تعديل',
                'name_en' => 'Edit',
                'key' => 'edit-page',
                'created_at' => '2022-04-09 03:14:05',
                'updated_at' => '2022-04-09 03:14:05',
            ),
            9 => 
            array (
                'id' => 55,
                'module' => 'pages',
                'name_ar' => 'حذف',
                'name_en' => 'Delete',
                'key' => 'delete-page',
                'created_at' => '2022-04-09 03:14:05',
                'updated_at' => '2022-04-09 03:14:05',
            ),
            10 => 
            array (
                'id' => 56,
                'module' => 'roles',
                'name_ar' => 'الصلاحيات',
                'name_en' => 'Roles',
                'key' => 'roles',
                'created_at' => '2022-04-09 03:14:05',
                'updated_at' => '2022-04-09 03:17:47',
            ),
            11 => 
            array (
                'id' => 57,
                'module' => 'roles',
                'name_ar' => 'انشاء',
                'name_en' => 'Create',
                'key' => 'create-role',
                'created_at' => '2022-04-09 03:14:05',
                'updated_at' => '2022-04-09 03:14:05',
            ),
            12 => 
            array (
                'id' => 58,
                'module' => 'roles',
                'name_ar' => 'عرض',
                'name_en' => 'Show',
                'key' => 'show-role',
                'created_at' => '2022-04-09 03:14:05',
                'updated_at' => '2022-04-09 03:14:05',
            ),
            13 => 
            array (
                'id' => 59,
                'module' => 'roles',
                'name_ar' => 'تعديل',
                'name_en' => 'Edit',
                'key' => 'edit-role',
                'created_at' => '2022-04-09 03:14:05',
                'updated_at' => '2022-04-09 03:14:05',
            ),
            14 => 
            array (
                'id' => 60,
                'module' => 'roles',
                'name_ar' => 'حذف',
                'name_en' => 'Delete',
                'key' => 'delete-role',
                'created_at' => '2022-04-09 03:14:05',
                'updated_at' => '2022-04-09 03:14:05',
            ),
            15 => 
            array (
                'id' => 185,
                'module' => 'users',
                'name_ar' => 'main.ajax-select2',
                'name_en' => 'main.ajax-select2',
                'key' => 'ajax-select2-user',
                'created_at' => '2022-07-26 12:24:45',
                'updated_at' => '2022-07-26 12:24:45',
            ),
        ));
        
        
    }
}