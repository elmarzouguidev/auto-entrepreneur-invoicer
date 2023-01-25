<div class="col-xl-9 col-lg-8">
    <div class="card">

        <ul class="nav nav-tabs nav-tabs-custom justify-content-center pt-2" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#all-settings" role="tab">
                    Taxes
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

                                        <h4 class="card-title">Taxes</h4>

                                        @include('theme.layouts._parts.__messages')

                                        <form method="POST" action="{{ route('admin:settings.taxes.store') }}">
                                            <div class="mb-3 row">
                                                <label for="name" class="col-md-2 col-form-label">
                                                    Nom de la taxe
                                                    *</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="text" name="name"
                                                        id="name" required>
                                                </div>
                                            </div>
                                            @csrf
                                            <div class="mb-3 row">
                                                <label for="invoice_start" class="col-md-2 col-form-label">Taux de la
                                                    taxe
                                                </label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="text" name="taux_percent"
                                                        id="taux_percent">
                                                </div>
                                            </div>
                                            <div class="d-flex flex-wrap gap-2">
                                                <button type="submit"
                                                    class="btn btn-primary waves-effect waves-light">Ajouter</button>
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
        @include('theme.pages.SettingV2.Taxe.list')
    </div>
</div>
