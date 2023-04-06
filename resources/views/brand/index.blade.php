@extends('layout.site')

@section('content')
    <h1>Каталог товаров</h1>

    <p>
        Перед Вами каталог товаров, которые представлены в нашем интернет-магазине
    </p>

    <h2>Бренды</h2>
    <div class="row">
        @foreach ($roots as $root)
            @include('brand.part.index', ['brand' => $root])
        @endforeach
    </div>
@endsection