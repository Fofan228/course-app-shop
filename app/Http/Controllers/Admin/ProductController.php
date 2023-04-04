<?php

    namespace App\Http\Controllers\Admin;

    use App\Helpers\ImageSaver;
    use App\Http\Controllers\Controller;
    use App\Http\Requests\ProductCatalogRequest;
    use App\Models\Brand;
    use App\Models\Category;
    use App\Models\Product;

    class ProductController extends Controller
    {
        private $imageSaver;

        public function __construct(ImageSaver $imageSaver)
        {
            $this->imageSaver = $imageSaver;
        }

        /**
         * Display a listing of the resource.
         */
        public function index()
        {
            // корневые категории для возможности навигации
            $roots = Category::where('parent_id', 0)->get();
            $products = Product::paginate(5);
            return view('admin.product.index', compact('products', 'roots'));
        }

        /**
         * Show the form for creating a new resource.
         */
        public function create()
        {
            // все категории для возможности выбора родителя
            $items = Category::all();
            // все бренды для возмозжности выбора подходящего
            $brands = Brand::all();
            return view('admin.product.create', compact('items', 'brands'));
        }

        /**
         * Store a newly created resource in storage.
         */
        public function store(ProductCatalogRequest $request)
        {
            $data = $request->except(['_token', '_method']);
            $data['image'] = $this->imageSaver->upload($request, null, 'product');
            $product = Product::create($data);
            session()->flash('Новый товар успешно создан');
            return redirect(route('admin.product.show', ['product' => $product->id]));
        }

        /**
         * Display the specified resource.
         */
        public function show(Product $product)
        {
            return view('admin.product.show', compact('product'));
        }

        /**
         * Show the form for editing the specified resource.
         */
        public function edit(Product $product)
        {
            // все категории для возможности выбора родителя
            $items = Category::all();
            // все бренды для возмозжности выбора подходящего
            $brands = Brand::all();
            return view('admin.product.edit', compact('product', 'items', 'brands'));
        }

        /**
         * Update the specified resource in storage.
         */
        public function update(ProductCatalogRequest $request, Product $product)
        {
            $data = $request->except(['_token', '_method']);
            $data['image'] = $this->imageSaver->upload($request, $product, 'product');
            $product->update($data);
            session()->flash('Товар был успешно обновлен');
            return redirect(route('admin.product.show', ['product' => $product->id]));
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy(Product $product)
        {
            $this->imageSaver->remove($product, 'product');
            $product->delete();
            session()->flash('Товар каталога успешно удален');
            return redirect(route('admin.category.index'));
        }

        public function category(Category $category)
        {
            $products = $category->products()->paginate(5);
            return view('admin.product.category', compact('category', 'products'));
        }
    }
