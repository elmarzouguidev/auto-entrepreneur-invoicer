<div class="modal fade addAdjustmentModal " data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
    aria-labelledby=orderdetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id=orderdetailsModalLabel">Créer un ajustement </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form class="repeater" method="post" action="{{ route('commercial:adjustments.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="row mb-4">

                                <label class="form-label">ENTREPÔT *</label>
                                <div class="col-lg-10">
                                    <select name="warehouse"
                                        class="form-control select2-templating @error('warehouse') is-invalid @enderror"
                                        required>
                                        <option value="">Choisir L'ENTREPÔT</option>
                                        @foreach ($warehouses as $warehouse)
                                            <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('warehouse')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row mb-4">
                                <label for="reference" class="form-label">Référence </label>
                                <div class="col-lg-10">
                                    <input id="reference" name="reference" type="text"
                                        class="form-control @error('reference') is-invalid @enderror"
                                        placeholder="Entrer le Référence ">
                                    @error('reference')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">

                        <div class="col-12">
                            <hr>
                            @include('theme.pages.Stock.Adjustment.__add_adjustment_products')

                        </div>
                    </div>
                    <div class="row">

                        <div class="col-12">
                            <hr>
                            <button type="submit" class="btn btn-block btn-primary">Ajouter</button>

                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

</div>
