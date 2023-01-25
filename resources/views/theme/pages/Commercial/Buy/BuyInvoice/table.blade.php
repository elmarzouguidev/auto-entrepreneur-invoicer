<div class="row" id="invoices_lister">

    {{-- @include('theme.pages.Commercial.Invoice.__datatable.__filters') --}}

    <div class="col-mg-12" id="invoices-list">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8">

                        <div class="col-lg-12 mb-4">
                            {{-- <a href="{{ route('buy:invoices.create') }}" type="button" class="btn btn-info">
                                Créer une facture
                            </a> --}}
                            <button class="btn btn-info" type="button" class="btn btn-info  btn-sm"
                                data-bs-toggle="modal" data-bs-target=".addInvoiceModal">
                                Ajouter une facture
                            </button>
                        </div>
                    </div>
                </div>

                @include('theme.layouts._parts.__messages')

                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            {{-- <th style="width: 20px;" class="align-middle">
                            <div class="form-check font-size-16">
                                <input class="form-check-input" type="checkbox" id="checkAll">
                                <label class="form-check-label" for="checkAll"></label>
                            </div>
                        </th> --}}
                            <th>{{ __('invoice.table.number') }}</th>
                            <th>{{ __('Fournisseur') }}</th>
                            <th>{{ __('Date de facture') }}</th>

                            <th>{{ __('Taxe') }}</th>
                            <th>{{ __('Montant Taxe') }}</th>
                            <th>{{ __('Montant HT') }}</th>
                            <th>{{ __('Montant Total') }}</th>

                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($invoices as $invoice)
                            <tr>
                                {{-- <td>
                                <div class="form-check font-size-16">
                                    <input class="form-check-input" type="checkbox"
                                        id="orderidcheck-{{ $invoice->id }}">
                                    <label class="form-check-label" for="orderidcheck-{{ $invoice->id }}"></label>
                                </div>
                            </td> --}}
                                <td>
                                    <a style="color:#556ee6" href="#" class="text-body fw-bold">
                                        <i class="bx bx-hash"></i> {{ $invoice->code }}
                                    </a>

                                </td>
                                <td>
                                    <a href="{{ optional($invoice->provider)->url }}" class="text-body fw-bold">
                                        {{ optional($invoice->provider)->entreprise }}
                                    </a>
                                </td>
                                <td>
                                    {{ $invoice->invoice_date->format('d-m-Y') }}
                                </td>

                                <td>
                                    {{ $invoice->taxe?->taux_percent }}
                                </td>
                                <td>
                                    {{ $invoice->formated_price_tva }} DH
                                </td>
                                <td>
                                    {{ $invoice->formated_price_ht }} DH
                                </td>
                                <td>
                                    {{ $invoice->formated_price_total }} DH
                                </td>

                                <td>
                                    <div class="d-flex gap-3">

                                        <a href="{{ route('buy:invoices.view', $invoice->uuid) }}" target="__blank"
                                            class="text-success">
                                            <i class="mdi mdi-file-pdf-outline font-size-18"></i>
                                        </a>

                                        <a href="{{ route('buy:invoices.edit', $invoice->uuid) }}"
                                            class="text-success">
                                            <i class="mdi mdi-pencil font-size-18"></i>
                                        </a>
                                        <button class="btn btn-danger btn-sm" type="button"
                                            onclick="
                                                var result = confirm('Are you sure you want to delete this invoice ?');

                                                if(result){
                                                    event.preventDefault();
                                                    document.getElementById('delete-invoice-{{ $invoice->uuid }}').submit();
                                                }">
                                            Supprimer
                                        </button>
                                    </div>
                                </td>
                                <form id="delete-invoice-{{ $invoice->uuid }}" method="post"
                                    action="{{ route('buy:invoices.delete') }}">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="invoiceId" value="{{ $invoice->uuid }}">
                                </form>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
