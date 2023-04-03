<?php

    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\Controller;
    use App\Models\Category;
    use Illuminate\Http\Request;

    class CategoryController extends Controller
    {
        /**
         * Display a listing of the resource.
         */
        public function index()
        {
            $roots = Category::roots();
            return view('admin.category.index', compact('roots'));
        }

        /**
         * Show the form for creating a new resource.
         */
        public function create()
        {
            $parents = Category::roots();
            return view('admin.category.create', compact('parents'));
        }

        /**
         * Store a newly created resource in storage.
         */
        public function store(Request $request)
        {
            $this->validate($request, [
                'parent_id' => 'integer',
                'name' => 'required|max:100',
                'slug' => 'required|max:100|unique:categories,slug|alpha_dash',
                'image' => 'mimes:jpeg,jpg,png|max:5000'
            ]);
            // проверка пройдена, сохраняем категорию
            $category = Category::create($request->except(['_token', '_method']));
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
            $parents = Category::roots();
            return view('admin.category.edit', compact('category', 'parents'));
        }

        /**
         * Update the specified resource in storage.
         */
        public function update(Request $request, Category $category)
        {
            // проверяем данные формы редактирования категории
            $id = $category->id;
            $this->validate($request, [
                'parent_id' => 'integer',
                'name' => 'required|max:100',
                /*
                 * Проверка на уникальность slug, исключая эту категорию по идентифкатору:
                 * 1. categories — таблица базы данных, где проверяется уникальность
                 * 2. slug — имя колонки, уникальность значения которой проверяется
                 * 3. значение, по которому из проверки исключается запись таблицы БД
                 * 4. поле, по которому из проверки исключается запись таблицы БД
                 * Для проверки будет использован такой SQL-запрос к базе данныхЖ
                 * SELECT COUNT(*) FROM `categories` WHERE `slug` = '...' AND `id` <> 17
                 */
                'slug' => 'required|max:100|unique:categories,slug,' . $id . ',id|alpha_dash',
                'image' => 'mimes:jpeg,jpg,png|max:5000'
            ]);
            // проверка пройдена, обновляем категорию
            $category->update($request->except(['_token', '_method']));
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
