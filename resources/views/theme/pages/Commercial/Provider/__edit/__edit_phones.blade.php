<div class="modal fade addPhones" tabindex="-1" role="dialog"
     aria-labelledby=orderdetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id=orderdetailsModalLabel">Ajouter autre numéro de téléphone</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="addEmail" id="addEmail" action="{{route('commercial:providers.add.phones',$provider->uuid)}}"
                      method="post">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        @foreach($provider->telephones as $phone)
                                            <div class="col-lg-9 mb-3">
                                                <input type="email"  class="form-control"
                                                       value="{{$phone->telephone}}" readonly
                                                />
                                            </div>
                                            <div class="col-lg-3">
                                                <button
                                                    type="button"
                                                    class="deleteProviderPhone btn btn-danger waves-effect waves-light"
                                                    data-provider="{{ $provider->uuid }}" data-phone="{{ $phone->uuid }}"
                                                >
                                                    supprimer
                                                </button>
                                            </div>
                                        @endforeach

                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <input type="text" name="secend_phone" class="inner form-control"
                                                   placeholder="Entrer numero ici" required
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap gap-2 justify-content-end mb-4">
                        <div class="">
                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                {{__('buttons.store')}}
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


