<div class="modal fade addBrandModal " data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
    aria-labelledby=orderdetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id=orderdetailsModalLabel">Ajouter une Marque </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form method="post" action="{{ route('commercial:brands.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="row mb-4">
                                <label for="name" class="col-form-label col-lg-2">Nom *</label>
                                <div class="col-lg-10">
                                    <input id="name" name="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror"
                                        placeholder="Entrer le nom du marque " required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="col-6">

                            <div class="row mb-3">
                                <label class="col-form-label col-lg-2">Logo </label>
                                <div class="col-lg-10">
                                    <input class="form-control @error('photo') is-invalid @enderror" name="photo"
                                        type="file" accept="image/*" />
                                    @error('photo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-form-label col-lg-1"></label>
                        <div class="col-lg-10">
                            <button type="submit" class="btn btn-block btn-primary">Ajouter</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

</div>
