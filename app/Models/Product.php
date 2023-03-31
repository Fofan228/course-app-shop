<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Product extends Model
    {
//        public function getCategory()
//        {
//            return DB::table('categories')
//                ->find($this->category_id);
//        }
//
//        public function getBrand()
//        {
//            return DB::table('brands')
//                ->find($this->brand_id);
//        }
        public function category()
        {
            return $this->belongsTo(Category::class);
        }

        public function brand()
        {
            return $this->belongsTo(Brand::class);
        }

        public function baskets() {
            return $this->belongsToMany(Basket::class)->withPivot('quantity');
        }
    }
