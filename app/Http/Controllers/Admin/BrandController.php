<?php

    namespace App\Http\Controllers\Admin;

    use App\Helpers\ImageSaver;
    use App\Http\Controllers\Controller;
    use App\Http\Requests\BrandCatalogRequest;
    use App\Models\Brand;

    class BrandController extends Controller
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
            $brands = Brand::all();
            return view('admin.brand.index', compact('brands'));
        }

        /**
         * Show the form for creating a new resource.
         */
        public function create()
        {
            return view('admin.brand.create');
        }

        /**
         * Store a newly created resource in storage.
         */
        public function store(BrandCatalogRequest $request)
        {
            $data = $request->except(['_token', '_method']);
            $data['image'] = $this->imageSaver->upload($request, null, 'brand');
            $brand = Brand::create($data);
            session()->flash('success', 'Новый бренд успешно создан');
            return redirect(route('admin.brand.show', ['brand' => $brand->id]));
        }

        /**
         * Display the specified resource.
         */
        public function show(Brand $brand)
        {
            return view('admin.brand.show', compact('brand'));
        }

        /**
         * Show the form for editing the specified resource.
         */
        public function edit(Brand $brand)
        {
            return view('admin.brand.edit', compact('brand'));
        }

        /**
         * Update the specified resource in storage.
         */
        public function update(BrandCatalogRequest $request, Brand $brand)
        {
            $data = $request->except(['_token', '_method']);
            $data['image'] = $this->imageSaver->upload($request, $brand, 'brand');
            $brand->update($data);
            session()->flash('success', 'Бренд был успешно отредактирован');
            return redirect(route('admin.brand.show', ['brand' => $brand->id]));
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy(Brand $brand)
        {
            if ($brand->products->count()) {
                return back()->withErrors('Нельзя удалить бренд, у которого есть товары');
            }
            $this->imageSaver->remove($brand, 'brand');
            $brand->delete();
            session()->flash('success', 'Бренд каталога успешно удален');
            return redirect(route('admin.brand.index'));
        }
    }
