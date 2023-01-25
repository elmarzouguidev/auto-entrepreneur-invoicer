<table class="table align-middle table-nowrap table-hover">
    <thead class="table-light">
        <tr>
            <th scope="col">Nom</th>
            <th scope="col">SYMBOLE</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($currencies as $currency)
            <tr>
                <td>
                    <h5 class="font-size-14 mb-1"><a href="javascript: void(0);"
                            class="text-dark">{{ $currency->name }}</a>
                    </h5>

                </td>
                <td>
                    <h5 class="font-size-14 mb-1"><a href="javascript: void(0);"
                            class="text-dark">{{ $currency->symbole }}</a>
                    </h5>

                </td>
                <td>
                    <div class="d-flex gap-3">

                        <a href="#" class="text-danger"
                            onclick="document.getElementById('delete-currency-{{ $currency->uuid }}').submit();">
                            <i class="mdi mdi-delete font-size-18"></i>
                        </a>

                    </div>
                </td>
            </tr>

            <form id="delete-currency-{{ $currency->uuid }}" method="post"
                action="{{ route('admin:settings.currency.delete') }}">
                @csrf
                @method('DELETE')
                <input type="hidden" name="currencyId" value="{{ $currency->uuid }}">
            </form>
        @endforeach

    </tbody>
</table>
