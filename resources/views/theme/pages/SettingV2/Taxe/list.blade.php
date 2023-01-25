
    <table class="table align-middle table-nowrap table-hover">
        <thead class="table-light">
            <tr>
                <th scope="col">Nom</th>
                <th scope="col">Taux</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($taxes as $taxe)
                <tr>
                    <td>
                        <h5 class="font-size-14 mb-1"><a href="javascript: void(0);"
                                class="text-dark">{{ $taxe->name }}</a>
                        </h5>

                    </td>

                    <td>{{ $taxe->taux_percent }}</td>
                    <td>
                        <div class="d-flex gap-3">

                            <a href="#" class="text-danger"
                                onclick="document.getElementById('delete-taxe-{{ $taxe->uuid }}').submit();">
                                <i class="mdi mdi-delete font-size-18"></i>
                            </a>

                        </div>
                    </td>
                </tr>

                <form id="delete-taxe-{{ $taxe->uuid }}" method="post"
                    action="{{ route('admin:settings.taxes.delete') }}">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="taxeId" value="{{ $taxe->uuid }}">
                </form>
            @endforeach

        </tbody>
    </table>

