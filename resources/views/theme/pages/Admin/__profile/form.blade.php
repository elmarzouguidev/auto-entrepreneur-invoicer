<div class="row">
    <div class="col-md-6 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Edit : {{ $admin->full_name }}</h4>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <form action="{{ route('admin:admins.update', $admin->uuid) }}" method="post">
                    @csrf
                    <div class="mb-3 row">
                        <label for="nom" class="col-md-2 col-form-label">Nom</label>
                        <div class="col-md-10">
                            <input class="form-control @error('nom') is-invalid @enderror" type="text" name="nom"
                                value="{{ $admin->nom }}" id="nom">
                            @error('nom')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="prenom" class="col-md-2 col-form-label">Prénom</label>
                        <div class="col-md-10">
                            <input class="form-control @error('prenom') is-invalid @enderror" type="text" name="prenom"
                                value="{{ $admin->prenom }}" id="prenom">
                            @error('prenom')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="example-email-input" class="col-md-2 col-form-label">E-mail</label>
                        <div class="col-md-10">
                            <input class="form-control @error('email') is-invalid @enderror" type="email" name="email"
                                value="{{ $admin->email }}" id="example-email-input">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="example-tel-input" class="col-md-2 col-form-label">Telephone</label>
                        <div class="col-md-10">
                            <input class="form-control @error('telephone') is-invalid @enderror" name="telephone"
                                type="tel" value="{{ $admin->telephone }}" id="example-tel-input">
                            @error('telephone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                     <div class="mb-3 row">
                        <label for="example-password-input" class="col-md-2 col-form-label">mot de pass</label>
                        <div class="col-md-10">
                            <input class="form-control @error('password') is-invalid @enderror" name="password" type="text"
                                id="example-password-input">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    {{-- @include('theme.pages.Admin.__profile.__select_multi_permissions') --}}

                    <div class="mb-3 row">
                        <label class="col-md-2 col-form-label">Role</label>
                        <div class="col-md-10">

                            <select name="role" class="form-select @error('role') is-invalid @enderror" required>
                                <option value="">Select role</option>
                                @foreach ($roles as $role)
                                    <option {{ $role->name === $admin->getRoleNames()->first() ? 'selected' : '' }}
                                        value="{{ $role->name }}">
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-md-2 col-form-label">Status</label>
                        <div class="col-md-10">
                            <div class="form-check mb-3">
                                <input class="form-check-input" name="active" {{$admin->active ?'checked':''}} type="checkbox" id="formCheck1">
                                <label class="form-check-label" for="formCheck1">
                                    Activé/Desactivé
                                </label>
                            </div>
                            @error('super_admin')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary w-md">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Permissions de {{ $admin->full_name }}</h4>
                @if (session('permissions'))
                    <div class="alert alert-success">
                        {{ session('permissions') }}
                    </div>
                @endif
                <form action="{{ route('admin:admins.syncPermissions', $admin->uuid) }}" method="post">
                    @csrf

                    {{-- @include('theme.pages.Admin.__profile.__select_multi_permissions') --}}
                    @include(
                        'theme.pages.Admin.__profile.__checkbox_permissions'
                    )
                    <div>
                        <button type="submit" class="btn btn-primary w-md">Sync Permissions</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
