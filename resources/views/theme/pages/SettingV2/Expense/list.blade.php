<table class="table align-middle table-nowrap table-hover">
    <thead class="table-light">
        <tr>
            <th scope="col">Nom</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $category)
            <tr>
                <td>
                    <h5 class="font-size-14 mb-1"><a href="javascript: void(0);"
                            class="text-dark">{{ $category->name }}</a>
                    </h5>

                </td>
                <td>
                    <div class="d-flex gap-3">

                        <a href="#" class="text-danger"
                            onclick="document.getElementById('delete-category-{{ $category->uuid }}').submit();">
                            <i class="mdi mdi-delete font-size-18"></i>
                        </a>

                    </div>
                </td>
            </tr>

            <form id="delete-category-{{ $category->uuid }}" method="post"
                action="{{ route('admin:settings.expense.delete') }}">
                @csrf
                @method('DELETE')
                <input type="hidden" name="categoryId" value="{{ $category->uuid }}">
            </form>
        @endforeach

    </tbody>
</table>
