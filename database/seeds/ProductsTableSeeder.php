<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 
use Carbon\Carbon;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('products')->delete();

        DB::table('products')->insert([
        [
            'sku' => '101',
            'name' => 'Pen',
            'stock' => 100,
            'price' => 15.0,
            'tax' => 3,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
    		'updated_at' => Carbon::now()->format('Y-m-d H:i:s')

        ],
        [
            'sku' => '102',
            'name' => 'Pencil',
            'stock' => 5,
            'price' => 5.0,
            'tax' => 5,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
    		'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ],
        [
	        'sku' => '103',
            'name' => 'Note Book',
            'stock' => 20,
            'price' => 205.5,
            'tax' => 12,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
    		'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ],
        [
            'sku' => '104',
            'name' => 'Books',
            'stock' => 100,
            'price' => 145.70,
            'tax' => 18,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
    		'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ],
        [
            'sku' => '105',
            'name' => 'Uniform',
            'stock' => 50,
            'price' => 240.50,
            'tax' => 28,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
    		'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]
    	]);
    }
}
