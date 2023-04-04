<?php

    namespace App\Http\Controllers\Admin;

    use App\Helpers\ImageSaver;
    use App\Http\Controllers\Controller;
    use App\Http\Requests\CategoryCatalogRequest;
    use App\Models\Category;

    class CategoryController extends Controller
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
            $items = Category::all();
            return view('admin.category.index', compact('items'));
        }

        /**
         * Show the form for creating a new resource.
         */
        public function create()
        {
            $items = Category::all();
            return view('admin.category.create', compact('items'));
        }

        /**
         * Store a newly created resource in storage.
         */
        public function store(CategoryCatalogRequest $request)
        {
            $data = $request->except(['_token', '_method']);
            $data['image'] = $this->imageSaver->upload($request, null, 'category');
            $category = Category::create($data);
            session()->flash('success', 'Новая категория успешно создана');
            return redirect(route('admin.category.show', ['category' => $category->id]));
        }

        /**
         * Display the specified resource.
         */
        public function show(Category $category)
        {
            return view('admin.category.show', compact('category'));
        }

        /**
         * Show the form for editing the specified resource.
         */
        public function edit(Category $category)
        {
            $items = Category::all();
            return view('admin.category.edit', compact('category', 'items'));
        }

        /**
         * Update the specified resource in storage.
         */
        public function update(CategoryCatalogRequest $request, Category $category)
        {
            $data = $request->except(['_token', '_method']);
            $data['image'] = $this->imageSaver->upload($request, $category, 'category');
            $category->update($data);
            session()->flash('success', 'Категория была успешно изменена');
            return redirect(route('admin.category.show', ['category' => $category->id]));
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy(Category $category)
        {
            if ($category->children) {
                $errors[] = 'Нельзя удалить категорию с дочерними категориями';
            }
            if ($category->products->count()) {
                $errors[] = 'Нельзя удалить категорию, которая содержит товары';
            }
            if (!empty($errors)) {
                return back()->withErrors($errors);
            }
            $category->delete();
            session()->flash('success', 'Категория каталога успешно удалена');
            return redirect(route('admin.category.index'));
        }
    }
