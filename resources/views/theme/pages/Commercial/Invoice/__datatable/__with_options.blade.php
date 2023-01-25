<div class="row" id="invoices_lister">

    {{-- @include('theme.pages.Commercial.Invoice.__datatable.__filters') --}}

    <div class="col-mg-12" id="invoices-list">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8">

                        <div class="col-lg-12 mb-4">
                            <a href="{{ route('commercial:invoices.create') }}" type="button" class="btn btn-info">
                                Créer une facture
                            </a>
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
                            <th>{{ __('invoice.table.client') }}</th>
                            <th>{{ __('invoice.table.date_invoice') }}</th>
                            <th>{{ __('invoice.table.total_ht') }}</th>
                            <th>{{ __('invoice.table.total_tva') }}</th>
                            {{-- <th>{{ __('invoice.table.total_total') }}</th> --}}
                            <th>{{ __('invoice.table.date_due') }}</th>
                            {{-- <th>{{ __('invoice.table.company') }}</th> --}}
                            <th>Status</th>
                            <th>Règlement</th>
                            <th>Envoyer</th>
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
                                    <a href="{{ optional($invoice->client)->url }}" class="text-body fw-bold">
                                        {{ optional($invoice->client)->entreprise }}
                                    </a>
                                </td>
                                <td>
                                    {{ $invoice->invoice_date->format('d-m-Y') }}
                                </td>
                                <td>
                                    {{ $invoice->formated_price_ht }} DH
                                </td>
                                <td>
                                    {{ $invoice->formated_total_tva }} DH
                                </td>
                                {{-- <td>
                                {{ $invoice->formated_price_total }} DH
                            </td> --}}

                                <td>
                                    {{ $invoice->due_date->format('d-m-Y') }}
                                </td>
                                <td>
                                    @php
                                        $status = $invoice->status;
                                        $textt = '';
                                        $color = '';
                                        if ($status == 'paid') {
                                            $textt = 'PAYÉE';
                                            $color = 'info';
                                        } elseif ($status == 'non-paid') {
                                            $textt = 'A régler';
                                            $color = 'warning';
                                        } else {
                                            $textt = 'IMPAYÉE';
                                            $color = 'warning';
                                        }
                                    @endphp

                                    <i class="mdi mdi-circle text-{{ $color }} font-size-10"></i>
                                    {{ $textt }}
                                </td>
                                <td>
                                    @if ($invoice->bill_count && $invoice->status == 'paid')
                                        <button type="button" class="btn btn-info  btn-sm" data-bs-toggle="modal"
                                            data-bs-target=".orderdetailsModal-{{ $invoice->id }}">
                                            Détails
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-warning  btn-sm" data-bs-toggle="modal"
                                            data-bs-target=".addPaymentToInvoice-{{ $invoice->uuid }}">
                                            Régler
                                        </button>
                                    @endif
                                </td>
                                <td>
                                    @if (!$invoice->is_send)
                                        <button type="button" class="btn btn-warning  btn-sm" data-bs-toggle="modal"
                                            data-bs-target=".sendInvoice-{{ $invoice->uuid }}">
                                            Envoyer
                                        </button>
                                    @else
                                        <a href="#" type="button" class="btn btn-info btn-sm">
                                            Déjà Envoyé
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex gap-3">

                                        <a href="#" target="__blank" class="text-success" data-bs-toggle="modal"
                                            data-bs-target=".printInvoice-{{ $invoice->uuid }}">
                                            <i class="mdi mdi-file-pdf-outline font-size-18"></i>
                                        </a>

                                        <a href="{{ $invoice->edit_url }}" class="text-success">
                                            <i class="mdi mdi-pencil font-size-18"></i>
                                        </a>

                                    </div>
                                </td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
