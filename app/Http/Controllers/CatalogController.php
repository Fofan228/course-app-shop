<?php

    namespace App\Http\Controllers;

    use App\Models\Brand;
    use App\Models\Category;
    use App\Models\Product;
    use Illuminate\Support\Facades\DB;

    class CatalogController extends Controller
    {
        public function index()
        {
            $roots = DB::table('categories')->where('parent_id', 0)->get();
            return view('catalog.index', compact('roots'));
        }

        public function category($slug)
        {
            $category = Category::with('products')->where('slug', $slug)->first();
//            $products = DB::table('products')->where('category_id', $category->id)->get();
            return view('catalog.category', compact('category'));
        }

        public function brand($slug)
        {
            $brand = Brand::with('products')->where('slug', $slug)->first();
//            $products = DB::table('products')->where('brand_id', $brand->id)->get();
            return view('catalog.brand', compact('brand'));
        }

        public function product($slug)
        {
//            $product = DB::table('products')
//                ->select(
//                    'products.*',
//                    'categories.name as category_name',
//                    'categories.slug as category_slug',
//                    'brands.name as brand_name',
//                    'brands.slug as brand_slug'
//                )
//                ->join('categories', 'products.category_id', '=', 'categories.id')
//                ->join('brands', 'products.brand_id', '=', 'brands.id')
//                ->where('products.slug', $slug)
//                ->first();
//            return view('catalog.product', compact('product'));
            $product = Product::with('category', 'brand')->where('slug', $slug)->first();
            return view('catalog.product', compact('product'));
        }
    }
