<div class="row" id="">

    <div class="col-mg-12" id="invoices-list">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="col-lg-4 mb-4">
                            <button class="btn btn-warning" type="button" class="btn btn-success  btn-sm"
                                data-bs-toggle="modal" data-bs-target=".addAutoModal">
                                Ajouter une automatisation
                            </button>
                        </div>

                        {{-- <div class="col-lg-12 mb-4">
                            <a href="{{ route('expense:create') }}" type="button" class="btn btn-info">
                                Enregistrer un dépenses
                            </a>
                        </div> --}}
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
                            <th>{{ __('Code') }}</th>
                            <th>{{ __('Nom') }}</th>
                            <th>{{ __('Catégorie') }}</th>
                            <th>{{ __('Fournisseur') }}</th>
                            <th>{{ __('Date') }}</th>
                            <th>{{ __('Répétition') }}</th>

                            <th>{{ __('Taxe') }}</th>
                            <th>{{ __('Montant Taxe') }}</th>
                            <th>{{ __('Montant HT') }}</th>
                            <th>{{ __('Montant Total') }}</th>

                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($expenses as $expense)
                            <tr>
                                {{-- <td>
                                <div class="form-check font-size-16">
                                    <input class="form-check-input" type="checkbox"
                                        id="orderidcheck-{{ $expense->id }}">
                                    <label class="form-check-label" for="orderidcheck-{{ $expense->id }}"></label>
                                </div>
                            </td> --}}
                                <td>
                                    <a style="color:#556ee6" href="#" class="text-body fw-bold">
                                        <i class="bx bx-hash"></i> {{ $expense->code }}
                                    </a>

                                </td>
                                <td>
                                    {{ $expense->name }}
                                </td>
                                <td>
                                    <a href="{{ $expense->category?->url }}" class="text-body fw-bold">
                                        {{ $expense->category?->name }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ $expense->provider?->url }}" class="text-body fw-bold">
                                        {{ $expense->provider?->entreprise }}
                                    </a>
                                </td>
                                <td>
                                    {{ $expense->expense_date->format('d-m-Y') }}
                                </td>
                                <td>
                                    {{ $expense->schedule?->name }}
                                </td>
                                <td>
                                    {{ $expense->taxe?->taux_percent }}
                                </td>
                                <td>
                                    {{ $expense->formated_price_tax }} DH
                                </td>
                                <td>
                                    {{ $expense->formated_price_ht }} DH
                                </td>
                                <td>
                                    {{ $expense->formated_price_total }} DH
                                </td>

                                <td>
                                    <div class="d-flex gap-3">

                                        <a href="#{{-- route('expense:automations.edit', $expense->uuid) --}}" class="text-success">
                                            <i class="mdi mdi-pencil font-size-18"></i>
                                        </a>
                                        <button class="btn btn-danger btn-sm" type="button"
                                            onclick="
                                                var result = confirm('Are you sure you want to delete this expense ?');

                                                if(result){
                                                    event.preventDefault();
                                                    document.getElementById('delete-expense-{{ $expense->uuid }}').submit();
                                                }">
                                            Supprimer
                                        </button>
                                    </div>
                                </td>
                                <form id="delete-expense-{{ $expense->uuid }}" method="post"
                                    action="{{ route('expense:automations.delete') }}">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="expenseId" value="{{ $expense->uuid }}">
                                </form>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
