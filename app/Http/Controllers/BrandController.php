<?php

    namespace App\Http\Controllers;

    use Illuminate\Support\Facades\DB;

    class BrandController extends Controller
    {
        public function index()
        {
            $roots = DB::table('brands')->get();
            return view('brand.index', compact('roots'));
        }
    }
