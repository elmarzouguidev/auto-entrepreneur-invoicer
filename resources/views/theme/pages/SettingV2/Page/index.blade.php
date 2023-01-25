@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @include('Sameleon.Admin.SettingV2.__title')

        <div class="row">

            @include('Sameleon.Admin.SettingV2.sidebar')
            
            @include('Sameleon.Admin.SettingV2.Page.content')
        </div>

    </div>
@endsection