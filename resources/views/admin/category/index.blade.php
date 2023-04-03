@extends('layout.admin')

@section('content')
    @if(count($errors) > 0)
        <ul class='error'>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <h1>Все категории</h1>
    <table class="table table-bordered">
        <tr>
            <th width="30%">Наименование</th>
            <th width="65%">Описание</th>
            <th><i class="fa fa-edit"></i></th>
            <th><i class="fa fa-trash"></i></th>
        </tr>
        @include('admin.category.part.tree', ['items' => $roots, 'level' => -1])
    </table>
@endsection