<div class="modal fade printEstimate-{{$estimate->uuid}}" tabindex="-1" role="dialog"
     aria-labelledby=orderdetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id=orderdetailsModalLabel">Telecharger le devis N° : {{$estimate->code}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <a target="_blank" href="{{ route('public.show.estimate',[$estimate->uuid,'has_header'=>true])}}"
                   class="btn btn-primary"

                >
                    avec entête
                </a>
                <a target="_blank" href="{{ route('public.show.estimate',[$estimate->uuid,'has_header'=>false])}}"
                   class="btn btn-info"

                >
                    sans entête
                </a>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

