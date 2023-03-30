<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Category extends Model
    {
//        public function getProducts()
//        {
//            return DB::table('products')
//                ->where('category_id', $this->id)
//                ->get();
//        }
        public function products()
        {
            return $this->hasMany(Product::class);
        }
    }
