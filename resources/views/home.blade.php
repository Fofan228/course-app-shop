@extends('layout.app')

@section('title', 'Главная страница')

@section('content')
    @include('partials.header')
    @include('product.product_card')
@endsection