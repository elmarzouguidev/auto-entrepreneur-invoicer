<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Forgot | Facturis Light</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}">
    <meta name="robots" content="noindex, nofollow" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />

</head>

<body>
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                        <div class="bg-primary bg-soft">
                            <div class="row">
                                <div class="col-7">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary"> Reset Password</h5>

                                    </div>
                                </div>
                                <div class="col-5 align-self-end">
                                    <img src="{{ asset('assets/images/profile-img.png') }}" alt=""
                                        class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div>
                                <a href="{{ route('admin:home') }}">
                                    <div class="avatar-md profile-user-wid mb-4">
                                        <span class="avatar-title rounded-circle bg-light">
                                            <img src="{{ asset('images/logo-app.png') }}" alt=""
                                                class="rounded-circle" height="70">
                                        </span>
                                    </div>
                                </a>
                            </div>

                            <div class="p-2">
                                @include('theme.layouts._parts.__messages')

                                <form autocomplete="off" class="form-horizontal"
                                    action="{{ route('forgotpasswordPost') }}" method="post">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="useremail"
                                            class="form-label @error('email') is-invalid @enderror">Email</label>
                                        <input id="useremail" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" placeholder="enter email" required
                                            autocomplete="email" autofocus>

                                    </div>

                                    <div class="text-end">
                                        <button class="btn btn-primary w-md waves-effect waves-light"
                                            type="submit">Reset
                                        </button>
                                    </div>

                                </form>
                            </div>

                        </div>
                    </div>
                    @include('theme.Authentification.auth_footer')

                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
