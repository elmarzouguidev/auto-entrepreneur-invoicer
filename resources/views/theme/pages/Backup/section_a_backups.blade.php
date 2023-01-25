<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <div class="row">
                        <div class="col-12 mb-4">
                            <button type="button" class="btn btn-info"
                            onclick="document.getElementById('makeBackup').submit();"
                            >
                             Sauvegarder
                            </button>
                            <form id="makeBackup" method="post"
                                action="{{ route('admin:backup:make') }}">
                                @csrf
                                <input type="hidden" name="backup" value="ok">
                            </form>
                        </div>
                    </div>
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

                    <table class="table align-middle table-nowrap table-hover">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Path</th>
                                <th scope="col">Created at</th>
                                <th scope="col">Size</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            @foreach ($files as $index => $file)
                                <tr>
                                    <td>{{ $file['path'] }}</td>
                                    <td>{{ $file['date'] }}</td>
                                    <td>{{ $file['size'] }}</td>
                                    <td class="text-right pr-3">
                                        <a class="action-button mr-2"
                                            onclick="document.getElementById('download-file-{{ $index }}').submit();"
                                            href="#">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                                height="24">
                                                <path class="heroicon-ui"
                                                    d="M11 14.59V3a1 1 0 0 1 2 0v11.59l3.3-3.3a1 1 0 0 1 1.4 1.42l-5 5a1 1 0 0 1-1.4 0l-5-5a1 1 0 0 1 1.4-1.42l3.3 3.3zM3 17a1 1 0 0 1 2 0v3h14v-3a1 1 0 0 1 2 0v3a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-3z" />
                                            </svg>
                                        </a>
                                        <a class="action-button" href="#"
                                        onclick="document.getElementById('delete-file-{{ $index }}').submit();">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                                height="24">
                                                <path class="heroicon-ui"
                                                    d="M8 6V4c0-1.1.9-2 2-2h4a2 2 0 0 1 2 2v2h5a1 1 0 0 1 0 2h-1v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8H3a1 1 0 1 1 0-2h5zM6 8v12h12V8H6zm8-2V4h-4v2h4zm-4 4a1 1 0 0 1 1 1v6a1 1 0 0 1-2 0v-6a1 1 0 0 1 1-1zm4 0a1 1 0 0 1 1 1v6a1 1 0 0 1-2 0v-6a1 1 0 0 1 1-1z" />
                                            </svg>
                                        </a>
                                    </td>
                                    <form id="download-file-{{ $index }}" method="post"
                                        action="{{ route('admin:backup:download') }}">
                                        @csrf
                             
                                        <input type="hidden" name="fileName" value="{{$file['path'] }}">
                                    </form>

                                    <form id="delete-file-{{ $index }}" method="post"
                                     action="{{ route('admin:backup:delete') }}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="fileName" value="{{$file['path']}}">
                                    </form>
                                </tr>
                            @endforeach
                            @if (!count($files))
                                <tr>
                                    <td class="text-center" colspan="4">
                                        {{ 'No backups present' }}
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <ul class="pagination pagination-rounded justify-content-center mt-4">
                            <li class="page-item disabled">
                                <a href="javascript: void(0);" class="page-link"><i
                                        class="mdi mdi-chevron-left"></i></a>
                            </li>
                            <li class="page-item">
                                <a href="javascript: void(0);" class="page-link">1</a>
                            </li>
                            <li class="page-item active">
                                <a href="javascript: void(0);" class="page-link">2</a>
                            </li>
                            <li class="page-item">
                                <a href="javascript: void(0);" class="page-link">3</a>
                            </li>
                            <li class="page-item">
                                <a href="javascript: void(0);" class="page-link">4</a>
                            </li>
                            <li class="page-item">
                                <a href="javascript: void(0);" class="page-link">5</a>
                            </li>
                            <li class="page-item">
                                <a href="javascript: void(0);" class="page-link"><i
                                        class="mdi mdi-chevron-right"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
