@if (!$command->is_send)
    <div class="modal fade sendBC-{{ $command->uuid }}" tabindex="-1" role="dialog"
         aria-labelledby=orderdetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id=orderdetailsModalLabel">Confirmer L'envoi du BC</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-2">BC N° : <span class="text-primary">{{ $command->full_number }}</span></p>
                    <p class="mb-2">Fournisseur  : <span class="text-primary">{{ optional($command->provider)->entreprise }}</span></p>

                    <p class="mb-2">sélectionner les emails : </p>
                    <form class="sendEstimate" id="sendBCForm-{{$command->uuid}}"
                          action="{{ route('buy:bcommandes.send') }}" method="post">
                        @csrf
                        <input type="hidden" name="bc" value="{{$command->uuid}}">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" checked disabled
                            >
                            <label class="form-check-label">
                                {{optional($command->provider)->email}} (email principal)
                            </label>
                        </div>
                        @foreach (optional($command->provider)->emails as $email)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="email-{{$email->id}}"
                                       name="emails[{{$command->id}}][]" value="{{$email->email}}">
                                <label class="form-check-label" for="email-{{$email->id}}">
                                    {{$email->email}}
                                </label>
                            </div>
                        @endforeach
                    </form>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary"
                            onclick="document.getElementById('sendBCForm-{{$command->uuid}}').submit();"
                    >
                        Envoyer
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endif
