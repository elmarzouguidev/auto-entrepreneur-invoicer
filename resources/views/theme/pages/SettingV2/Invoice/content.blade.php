<div class="col-xl-9 col-lg-8">
    <div class="card">

        <ul class="nav nav-tabs nav-tabs-custom justify-content-center pt-2" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#all-settings" role="tab">
                    Facturation
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


                                        <h4 class="card-title">Facturation</h4>
                                        @if (session('success'))
                                            <div class="alert alert-success">
                                                {{ session('success') }}
                                            </div>
                                        @endif
                                        @if (session('error'))
                                            <div class="alert alert-danger">
                                                {{ session('error') }}
                                            </div>
                                        @endif
                                        @if ($errors->any())
                                            @foreach ($errors->all() as $error)
                                                <div class="alert alert-danger">{{ $error }}</div>
                                            @endforeach
                                        @endif
                                        <form method="POST" action="{{ route('admin:settings.invoice.store') }}">
                                            <div class="mb-3 row">
                                                <label for="invoice_prefix" class="col-md-2 col-form-label">Préfix de la
                                                    facture
                                                    *</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="text" name="invoice_prefix"
                                                        value="{{ $setting->invoice_prefix }}" id="name" required>
                                                </div>
                                            </div>
                                            @csrf
                                            <div class="mb-3 row">
                                                <label for="invoice_start" class="col-md-2 col-form-label">Numérotation
                                                    de la
                                                    facture</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="number" name="invoice_start"
                                                        value="{{ $setting->invoice_start }}" id="invoice_start">
                                                </div>
                                            </div>
                                            <div class="d-flex flex-wrap gap-2">
                                                <button type="submit"
                                                    class="btn btn-primary waves-effect waves-light">update</button>
                                            </div>
                                        </form>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
