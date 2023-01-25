<div class="col-xl-9 col-lg-8">
    <div class="card">

        <ul class="nav nav-tabs nav-tabs-custom justify-content-center pt-2" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#all-settings" role="tab">
                    Mon entreprise
                </a>
            </li>
        </ul>

        <div class="tab-content p-4">
            <div class="tab-pane active" id="all-settings" role="tabpanel">
                <div>
                    <div class="row justify-content-center">
                        <div class="col-xl-12">
                            <div>
                                <div class="row align-items-center">
                                    <div class="col-4">
                                        <div>
                                            <h5 class="mb-0"></h5>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->

                                <div>
                                    <div class="col-12">

                                        @include('theme.layouts._parts.__messages')

                                        <form method="POST" action="{{ route('admin:settings.store') }}"
                                            enctype="multipart/form-data">
                                            <div class="mb-3 row">
                                                <label for="name" class="col-md-2 col-form-label">Nom *</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="text" name="name"
                                                        value="{{ $setting->name }}" id="name" required>
                                                </div>
                                            </div>
                                            @csrf
                                            <div class="mb-3 row">
                                                <label for="website" class="col-md-2 col-form-label">website</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="text" name="website"
                                                        value="{{ $setting->website }}" id="website">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="email" class="col-md-2 col-form-label">E-mail *</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="email" name="email"
                                                        value="{{ $setting->email }}" placeholder="E-mail"
                                                        id="email" required>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="rc" class="col-md-2 col-form-label">RC</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" name="rc" type="number"
                                                        value="{{ $setting->rc }}" placeholder="RC" id="rc">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="ice" class="col-md-2 col-form-label">ICE *</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="number" name="ice"
                                                        value="{{ $setting->ice }}" placeholder="ICE" id="ice"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="cnss" class="col-md-2 col-form-label">CNSS</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="number" name="cnss"
                                                        value="{{ $setting->cnss }}" placeholder="CNSS" id="cnss">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="patente" class="col-md-2 col-form-label">PATENTE *</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="number" name="patente"
                                                        value="{{ $setting->patente }}" placeholder="PATENTE"
                                                        id="patente" required>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="if" class="col-md-2 col-form-label">IF *</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="number" name="if"
                                                        value="{{ $setting->if }}" placeholder="IF" id="if"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="telephone" class="col-md-2 col-form-label">Telephone
                                                    *</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="tel" name="telephone_a"
                                                        value="{{ $setting->telephone_a }}" id="telephone" required>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="telephone_b" class="col-md-2 col-form-label">Telephone
                                                    2</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="tel" name="telephone_b"
                                                        value="{{ $setting->telephone_b }}" id="telephone_b">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="addresse" class="col-md-2 col-form-label">Adresse
                                                    *</label>
                                                <div class="col-md-10">
                                                    <textarea class="form-control" name="addresse" id="addresse" required>{{ $setting->addresse }}</textarea>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="bank_name" class="col-md-2 col-form-label">Banque
                                                    *</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="text" name="bank_name"
                                                        value="{{ $setting->bank_name }}" placeholder="bank_name"
                                                        id="bank_name">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="bank_rib" class="col-md-2 col-form-label">RIB *</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="number" name="bank_rib"
                                                        value="{{ $setting->bank_rib }}" placeholder="bank_rib"
                                                        id="bank_rib">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="addresse" class="col-md-2 col-form-label">LOGO</label>
                                                <div class="col-md-10">

                                                    <img src="{{ appLogo() }}" class="img-fluid" width="9%">

                                                    <input class="form-control @error('logo') is-invalid @enderror"
                                                        name="logo" type="file" accept="image/*" />
                                                    @error('photo')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="d-flex flex-wrap gap-2">
                                                <button type="submit"
                                                    class="btn btn-primary waves-effect waves-light">update</button>
                                            </div>
                                        </form>

                                    </div> <!-- end col -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
