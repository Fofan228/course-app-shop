<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Product extends Model
    {
        protected $fillable = [
            'category_id',
            'brand_id',
            'name',
            'slug',
            'content',
            'price',
            'image',
        ];

        public function category()
        {
            return $this->belongsTo(Category::class);
        }

        public function brand()
        {
            return $this->belongsTo(Brand::class);
        }

        public function baskets()
        {
            return $this->belongsToMany(Basket::class)->withPivot('quantity');
        }
    }
