@extends('theme.layouts.app')

@section('content')
    <div class="container-fluid">

        @include('theme.pages.SettingV2.__title')

        <div class="row">

            @include('theme.pages.SettingV2.sidebar')
            
            @include('theme.pages.SettingV2.payment-method.content')

        </div>

    </div>
@endsection