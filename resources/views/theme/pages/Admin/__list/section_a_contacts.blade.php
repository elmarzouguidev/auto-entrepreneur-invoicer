<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-middle table-nowrap table-hover">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" style="width: 70px;">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Status</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admins as $admin)
                                <tr>
                                    <td>
                                        <div class="avatar-xs">
                                            <span class="avatar-title rounded-circle">
                                                {{ $admin->full_name[0] }}
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <h5 class="font-size-14 mb-1"><a href="javascript: void(0);"
                                                class="text-dark">{{ $admin->full_name }}</a></h5>
                                        <p class="text-muted mb-0">{{ $admin->getRoleNames()->first() }}</p>
                                    </td>
                                    <td>
                                        {{ $admin->active ?'Activé':'Désactivé (Ce compte ne peut être connecter)' }}
                                    </td>
                                    <td>{{ $admin->email }}</td>

                                    <td>
                                        {{ $admin->telephone }}
                                    </td>
                                    <td>
                                        <div class="d-flex gap-3">
                                            @if ($admin->email !== 'abdelgha4or@gmail.com')
                                                <a href="{{ route('admin:admins.edit', $admin->uuid) }}"
                                                    class="text-success"><i
                                                        class="mdi mdi-pencil font-size-18"></i></a>
                                                
                                                <a href="#" class="text-danger"
                                                    onclick="document.getElementById('delete-admin-{{ $admin->uuid }}').submit();">
                                                    <i class="mdi mdi-delete font-size-18"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @if ($admin->email !== 'abdelgha4or@gmail.com')
                                    <form id="delete-admin-{{ $admin->uuid }}" method="post"
                                        action="{{ route('admin:admins.delete') }}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="adminId" value="{{ $admin->uuid }}">
                                    </form>
                                @endif
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
