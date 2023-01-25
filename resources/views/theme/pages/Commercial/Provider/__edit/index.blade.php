@extends('theme.layouts.app')

@section('content')

<div class="container-fluid">

    @include('theme.pages.Commercial.Provider.section_0_page_title')

    @include('theme.pages.Commercial.Provider.__edit.form_2')

</div>

@endsection

@section('css')

@endsection

@once

@push('scripts')

    <script>
        $(".deleteProviderPhone").click(function (event) {

            event.preventDefault();

            var result = confirm('Are you sure you want to delete this record?');

            var provider = $(this).data("provider");
            var phone = $(this).data("phone");
            var token = $("meta[name='csrf-token']").attr("content");

            if (result) {

                $.ajax({
                    url: "{{ route('commercial:providers.delete.phone') }}",
                    type: 'DELETE',
                    data: {
                        "provider": provider,
                        "phone": phone,
                        "_token": token,
                    },
                    success: function () {
                        console.log("it Works");
                        window.location.reload();
                    }
                });
            }

        });
    </script>

    <script>
        $(".deleteProviderEmail").click(function (event) {

            event.preventDefault();

            var result = confirm('Are you sure you want to delete this email?');

            var provider = $(this).data("provider");
            var email = $(this).data("email");
            var token = $("meta[name='csrf-token']").attr("content");

            if (result) {

                $.ajax({
                    url: "{{ route('commercial:providers.delete.email') }}",
                    type: 'DELETE',
                    data: {
                        "provider": provider,
                        "email": email,
                        "_token": token
                    },
                    success: function () {
                        console.log("it Works");
                        window.location.reload();
                    }
                });
            }

        });
    </script>
@endpush

@endonce
