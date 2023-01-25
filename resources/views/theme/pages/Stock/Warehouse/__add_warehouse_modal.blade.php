<div class="modal fade addWarehouseModal " data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
    aria-labelledby=orderdetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id=orderdetailsModalLabel">Ajouter un Entrepôt </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form method="post" action="{{ route('commercial:warehouses.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="row mb-4">
                                <label for="name" class="col-form-label col-lg-3">Nom *</label>
                                <div class="col-lg-9">
                                    <input id="name" name="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror"
                                        placeholder="Entrer le nom d'entrepôt " required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">

                                <label class="col-lg-3 form-label">Ville *</label>
                                <div class="col-lg-9">
                                    <select name="city"
                                        class="form-control select2-templating @error('city') is-invalid @enderror"
                                        required>
                                        <option value="">Choisir la ville</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('city')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>
                            <div class="row mb-4">
                                <label for="address" class="col-form-label col-lg-3">Adresse * </label>
                                <div class="col-lg-9">
                                    <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="2"
                                        placeholder="Entrer l'adresse d'entrepôt " required></textarea>
                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row mb-3">

                                <label class="col-lg-3 form-label">Résponsable</label>
                                <div class="col-lg-9">
                                    <select name="user"
                                        class="form-control select2-templating @error('user') is-invalid @enderror"
                                        >
                                        <option value="">Choisir le résponsable</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('user')
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
