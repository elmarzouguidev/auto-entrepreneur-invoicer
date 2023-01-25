@if ($adjustment->adjustments_products_count)
    <div class="modal fade showAdjustmentHistory{{ $adjustment->uuid }}" tabindex="-1" role="dialog"
        aria-labelledby=orderdetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id=orderdetailsModalLabel">Ajustement REF : {{ $adjustment->reference }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        @foreach ($adjustment->histories as $history)
                            <li class="list-group-item">
                                <b>{{ $history->user }}</b> {{ $history->detail }} :
                                <b class="text-danger">
                                    {{ $history->created_at->format('d-m-Y H:i') }}
                                </b>

                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endif
