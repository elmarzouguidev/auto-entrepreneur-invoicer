<div class="row">
    <div class="card mb-4">
        <div class="card-body">
            <p class="card-title-desc">Actions disponible :</p>
            <div class="col-lg-12">
                <div class="button-items">
                    {{--<a target="_blank"
                       href="{{ route('public.show.estimate',$estimate->uuid)}}"
                       class="btn btn-primary waves-effect waves-light w-sm">
                        <i class="mdi mdi-file-pdf d-block font-size-16"></i> Télécharger
                    </a>--}}
                    <button type="button" class="btn btn-primary waves-effect waves-light w-sm"
                            data-bs-toggle="modal"
                            data-bs-target=".printInvoice-{{ $invoice->uuid }}"
                    >
                        <i class="mdi mdi-file-pdf d-block font-size-16"></i> Télécharger
                    </button>
                    @if (!$invoice->is_send)
                        <button type="button" class="btn btn-warning waves-effect waves-light w-sm"
                                data-bs-toggle="modal"
                                data-bs-target=".sendInvoice-{{ $invoice->uuid }}"
                        >
                            <i class="mdi mdi-mail d-block font-size-16"></i> Envoyer
                        </button>
                    @else
                        <button type="button" class="btn btn-light waves-effect waves-light w-sm"

                        >
                            <i class="mdi mdi-mail d-block font-size-16"></i> Déja Envoyer
                        </button>
                    @endif

                    <button type="button" class="btn btn-danger waves-effect waves-light w-sm" id="deleteInvoice">
                        <i class="mdi mdi-trash-can d-block font-size-16"></i> Supprimer
                    </button>

                    <form id="delete-invoice-single-{{ $invoice->uuid }}" method="post"
                          action="{{ route('commercial:invoices.delete') }}">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="invoiceId" value="{{ $invoice->uuid }}">
                    </form>
                </div>
            </div>

        </div>

    </div>
</div>
@include('theme.pages.Commercial.Invoice.__edit.__historique_invoice')
