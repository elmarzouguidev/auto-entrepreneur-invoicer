<div class="modal fade addPhones" tabindex="-1" role="dialog" aria-labelledby=orderdetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id=orderdetailsModalLabel">Ajouter numéro de tél</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="addPhone" id="addPhone" action="{{ route('admin:client.add.phones', $client->uuid) }}"
                    method="post">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        @foreach ($client->telephones as $phone)
                                            <div class="col-lg-4">
                                                <input type="text" name="phone" class="inner form-control"
                                                    value="{{ $phone->telephone }}" readonly />
                                            </div>
                                            <div class="col-lg-4">
                                                <select name="type" class="form-select" readonly>
                                                    <option value="{{ $phone->type }}" selected>{{ $phone->type }}
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col-lg-4 mb-3">
                                                <div class="d-grid">
                                                    <input  type="button"
                                                        class="deletePhone btn btn-danger inner
                                                  "
                                                        value="Supprimer" data-client="{{ $client->uuid }}"
                                                        data-phone="{{ $phone->uuid }}" />
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <input type="text" name="telephone" class="form-control" placeholder="Enter le numéro ..."/>
                                        </div>
                                        <div class="col-lg-4">
                                            <select name="type" class="form-select">
                                                <option value="fix" selected>Fix</option>
                                                <option value="portable">portable</option>
                                                <option value="autre">autre</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap gap-2 justify-content-end mb-4">
                        <div class="">
                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                {{ __('buttons.store') }}
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
