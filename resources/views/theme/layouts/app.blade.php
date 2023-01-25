<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8" />
    <title> {{ getCompany()->name ?? 'Facturis' }} CRM</title>
    <meta name="robots" content="noindex, nofollow" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="app_creator" name="Elmarzougui Abdelghafour" />
    <meta content="app_version" name="v 1.1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('images/logo-app.png') }}">
    <link href="{{ asset('assets/libs/magnific-popup/magnific-popup.css') }}" rel="stylesheet" type="text/css" />
    @yield('css')
    <!-- App Css-->
    <link href="{{ asset('css/app.css') }}?ver={{ rand(2, 250) }}" rel="stylesheet" type="text/css" />

    @livewireStyles

</head>

<body {{-- data-sidebar="dark" --}} data-sidebar-size="small-">

    <div id="preloader">
        <div id="status">
            <div class="spinner-chase">
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
            </div>
        </div>
    </div>
    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

    <div id="layout-wrapper">

        @include('theme.layouts._parts.__header')

        @include('theme.layouts._parts._leftSidebar')

        <div class="main-content">

            <div class="page-content">

                <div id="overlayy"></div>

                @yield('content')

            </div>

            {{-- @include('theme.layouts._parts._subscribe') --}}


            @include('theme.layouts._parts._footer')

        </div>


    </div>


    {{-- @include('theme.layouts._parts._rightSidebar') --}}


    @include('theme.layouts._parts._overly')

    @livewireScripts

    <script src="{{ asset('js/app.js') }}"></script>

    @stack('scripts')

    @stack('reloadModal')

    <script src="{{ asset('assets/libs/magnific-popup/jquery.magnific-popup.min.js') }}"></script>

    <script src="{{ asset('js/pages/lightbox.init.js') }}"></script>
</body>

</html>
