@extends('theme.layouts.app')

@section('content')
    <div class="container-fluid">

        @include('theme.pages.Excel.__section_title')

        @include('theme.pages.Excel.__content')

    </div>
@endsection

@push('scripts')
    {{--<script src="{{ asset('js/pages/file-manager.init.js') }}"></script>--}}
@endpush
