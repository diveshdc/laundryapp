<?php

use Illuminate\Database\Seeder;
use App\Category;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $category = [[
            'name'        => 'Trousers',
            'image'       =>'null',
            'description' =>'this is Trousers description',
            'deleted_at'  => NULL
            
        ],
        [
            'name'        => 'Accesories',
            'image'       =>'null',
            'description' =>'this is Accesories description',
            'deleted_at'  => NULL
            
        ],
        [
            'name'         => 'Alterations',
            'image'        =>'null',
            'description'  =>'this is Alterations description',
            'deleted_at'   => NULL
            
        ],
        [
            'name'        => 'Household',
            'image'       =>'null',
            'description' =>'this is Household description',
            'deleted_at'  => NULL
            
        ],
        [
            'name'        => 'Dress & Skirts',
            'image'       =>'null',
            'description' =>'this is Dress & Skirts description',
            'deleted_at'  => NULL
            
        ],
        [
            'name'        => 'Iron only',
            'image'       =>'null',
            'description' =>'this is Iron only description',
            'deleted_at'  => NULL
            
        ],
        [
            'name'        => 'Laundry',
            'image'       =>'null',
            'description' =>'this is Laundry description',
            'deleted_at'  => NULL
            
        ],
        [
            'name'        => 'Outdoors',
            'image'       =>'null',
            'description' =>'this is Outdoors description',
            'deleted_at'  => NULL
            
        ],
        [
            'name'        => 'Tops',
            'image'       =>'null',
            'description' =>'this is Tops description',
            'deleted_at'  => NULL
            
        ],
        [
            'name'        => 'Suits',
            'image'       =>'null',
            'description' =>'this is Suits description',
            'deleted_at'  => NULL
            
        ],
        [
            'name'        => 'Bundle Deals',
            'image'       =>'null',
            'description' =>'this is Bundle Deals description',
            'deleted_at'  => NULL
            
        ]
    ];

        Category::insert($category);
    }
}
