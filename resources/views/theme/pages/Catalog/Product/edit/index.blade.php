@extends('theme.layouts.app')

@section('content')

    <div class="container-fluid">

        @include('theme.pages.Catalog.Product.__title')
        
        @include('theme.pages.Catalog.Product.edit.__form')
        
    </div>

@endsection

@section('css')

@endsection

@push('scripts')
   
@endpush
