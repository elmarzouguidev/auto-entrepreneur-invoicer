<div class="col-xl-12">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Mes Factures</h4>

                    <div class="text-center">
                        <div class="mb-4">
                            <i class="bx bx-file text-primary display-4"></i>
                        </div>
                        <h3>Facture Total : {{ $allInvoices }}</h3>
                        <p></p>
                    </div>

                    <div class="table-responsive mt-4">
                        <table class="table align-middle table-nowrap">
                            <tbody>
                                <tr>
                                    <td style="width: 30%">
                                        <p class="mb-0">Facture payé</p>
                                    </td>
                                    <td style="width: 25%">
                                        <h5 class="mb-0">{{ $invoicesPaid }}</h5>
                                    </td>
                                    <td>
                                        <div class="progress bg-transparent progress-sm">
                                            <div class="progress-bar bg-primary rounded" role="progressbar"
                                                style="width: 94%" aria-valuenow="94" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 30%">
                                        <p class="mb-0">Facture En attente de paiement</p>
                                    </td>
                                    <td style="width: 25%">
                                        <h5 class="mb-0">{{ $invoicesNotPaid }}</h5>
                                    </td>
                                    <td>
                                        <div class="progress bg-transparent progress-sm">
                                            <div class="progress-bar bg-primary rounded" role="progressbar"
                                                style="width: 94%" aria-valuenow="94" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="mb-0">Facture échue</p>
                                    </td>
                                    <td>
                                        <h5 class="mb-0">{{ $invoicesRetard }}</h5>
                                    </td>
                                    <td>
                                        <div class="progress bg-transparent progress-sm">
                                            <div class="progress-bar bg-success rounded" role="progressbar"
                                                style="width: 82%" aria-valuenow="82" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Mes Devis</h4>

                    <div class="text-center">
                        <div class="mb-4">
                            <i class="bx bx-file text-primary display-4"></i>
                        </div>
                        <h3>Total DEVIS : {{ $allEstimates }}</h3>
                        <p></p>
                    </div>

                    <div class="table-responsive mt-4">
                        <table class="table align-middle table-nowrap">
                            <tbody>
                                <tr>
                                    <td style="width: 30%">
                                        <p class="mb-0">DEVIS accépté</p>
                                    </td>
                                    <td style="width: 25%">
                                        <h5 class="mb-0">{{ $estimatesAccepted }}</h5>
                                    </td>
                                    <td>
                                        <div class="progress bg-transparent progress-sm">
                                            <div class="progress-bar bg-primary rounded" role="progressbar"
                                                style="width: 94%" aria-valuenow="94" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 30%">
                                        <p class="mb-0">DEVIS En attente</p>
                                    </td>
                                    <td style="width: 25%">
                                        <h5 class="mb-0">{{ $estimatesNotInvoiced }}</h5>
                                    </td>
                                    <td>
                                        <div class="progress bg-transparent progress-sm">
                                            <div class="progress-bar bg-primary rounded" role="progressbar"
                                                style="width: 94%" aria-valuenow="94" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 30%">
                                        <p class="mb-0">DEVIS Refusé</p>
                                    </td>
                                    <td style="width: 25%">
                                        <h5 class="mb-0">{{ $estimatesExpired }}</h5>
                                    </td>
                                    <td>
                                        <div class="progress bg-transparent progress-sm">
                                            <div class="progress-bar bg-primary rounded" role="progressbar"
                                                style="width: 94%" aria-valuenow="94" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
