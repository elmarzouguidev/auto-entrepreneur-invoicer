<div class="d-xl-flex">
    <div class="w-100">
        <div class="d-md-flex">

            @include('theme.pages.Excel.__sidebar')

            <div class="w-100">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <div class="row mb-3">
                                <div class="col-xl-3 col-sm-6">
                                    <div class="mt-2">
                                        <h5>Fichiers</h5>
                                    </div>
                                </div>
                                <div class="col-xl-9 col-sm-6">
                                    <form class="mt-4 mt-sm-0 float-sm-end d-flex align-items-center">
                                        <div class="search-box mb-2 me-2">
                                            <div class="position-relative">
                                                <input type="text" class="form-control bg-light border-light rounded"
                                                    placeholder="Search...">
                                                <i class="bx bx-search-alt search-icon"></i>
                                            </div>
                                        </div>

                                        <div class="dropdown mb-0">
                                            <a class="btn btn-link text-muted dropdown-toggle mt-n2" role="button"
                                                data-bs-toggle="dropdown" aria-haspopup="true">
                                                <i class="mdi mdi-dots-vertical font-size-20"></i>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item"
                                                    href="{{ route('admin:backup:manager.index', ['disk' => 'google']) }}">Google
                                                    Drive</a>
                                                <a class="dropdown-item"
                                                    href="{{ route('admin:backup:manager.index', ['disk' => 'dropbox']) }}">DropBox</a>

                                            </div>
                                        </div>


                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- @include('theme.pages.Excel.__folders') --}}

                        <div class="mt-4">
                            <div class="d-flex flex-wrap">
                                <h5 class="font-size-16 me-3">Sauvegarde récente</h5>

                                <div class="ms-auto">
                                    <a href="javascript: void(0);" class="fw-medium text-reset">View All</a>
                                </div>
                            </div>
                            <hr class="mt-2">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <div class="table-responsive">
                                <table class="table align-middle table-nowrap table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nom du fichier</th>
                                            <th scope="col">Date de création</th>
                                            <th scope="col" colspan="2">Size</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($files as $index => $file)
                                            <tr>
                                                <td>
                                                    <a href="javascript: void(0);" class="text-dark fw-medium"><i
                                                            class="mdi mdi-folder-zip font-size-16 align-middle text-warning me-2"></i>
                                                        {{ $file['path'] }}
                                                    </a>
                                                </td>
                                                <td>{{ $file['date'] }}</td>
                                                <td>{{ $file['size'] }}</td>
                                                <td>
                                                    <a class="action-button mr-2"
                                                        onclick="document.getElementById('download-file-{{ $index }}').submit();"
                                                        href="#">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                            width="24" height="24">
                                                            <path class="heroicon-ui"
                                                                d="M11 14.59V3a1 1 0 0 1 2 0v11.59l3.3-3.3a1 1 0 0 1 1.4 1.42l-5 5a1 1 0 0 1-1.4 0l-5-5a1 1 0 0 1 1.4-1.42l3.3 3.3zM3 17a1 1 0 0 1 2 0v3h14v-3a1 1 0 0 1 2 0v3a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-3z" />
                                                        </svg>
                                                    </a>
                                                    <a class="action-button" href="#"
                                                        onclick="document.getElementById('delete-file-{{ $index }}').submit();">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                            width="24" height="24">
                                                            <path class="heroicon-ui"
                                                                d="M8 6V4c0-1.1.9-2 2-2h4a2 2 0 0 1 2 2v2h5a1 1 0 0 1 0 2h-1v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8H3a1 1 0 1 1 0-2h5zM6 8v12h12V8H6zm8-2V4h-4v2h4zm-4 4a1 1 0 0 1 1 1v6a1 1 0 0 1-2 0v-6a1 1 0 0 1 1-1zm4 0a1 1 0 0 1 1 1v6a1 1 0 0 1-2 0v-6a1 1 0 0 1 1-1z" />
                                                        </svg>
                                                    </a>
                                                </td>
                                                <form id="download-file-{{ $index }}" method="post"
                                                    action="{{ route('admin:backup:download') }}">
                                                    @csrf

                                                    <input type="hidden" name="fileName" value="{{ $file['path'] }}">
                                                </form>

                                                <form id="delete-file-{{ $index }}" method="post"
                                                    action="{{ route('admin:backup:delete') }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="fileName" value="{{ $file['path'] }}">
                                                    <input type="hidden" name="diskName" value="{{ request()->input('disk') }}">
                                                </form>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card -->
            </div>
            <!-- end w-100 -->
        </div>
    </div>
    @include('theme.pages.Excel.__rightbar')

</div>
