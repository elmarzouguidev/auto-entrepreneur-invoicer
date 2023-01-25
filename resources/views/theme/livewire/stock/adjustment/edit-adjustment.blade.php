<div class="modal fade editAdjustmentModel " data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
    aria-labelledby=orderdetailsModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id=orderdetailsModalLabel">Edition d'ajustement {{ $adjustment->reference }}
                </h5>
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
                                        required disabled>

                                        <option selected value="{{ $adjustment->warehouse?->id }}">
                                            {{ $adjustment->warehouse?->name }}</option>

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
                                        value="{{ $adjustment->reference }}" disabled>
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
                            <div data-repeater-list="products">
                                @foreach ($adjustment->adjustmentsProducts as $adjustProd)
                                    @livewire('stock.adjustment.edit-adjustment-detail', ['adjustProd' => $adjustProd], key($loop->index))
                                @endforeach
                            </div>
                            <hr>
                            <p>ajouter des produits</p>
                        </div>
                        
                        @include('theme.livewire.stock.adjustment.add_products')
                        
                    </div>
                    {{--<div class="row">

                        <div class="col-12">
                            <hr>
                            <button type="submit" class="btn btn-block btn-primary">Update</button>

                        </div>
                    </div>--}}
                </form>

            </div>
        </div>
    </div>
</div>
