<div class="row">
    <div class="col-12">
        <!-- Left sidebar -->
    @include('theme.pages.Setting.__menu')
    <!-- End Left sidebar -->

        <!-- Right Sidebar -->
        <div class="email-rightbar mb-3">

            <div class="card">
                <div class="btn-toolbar p-3" role="toolbar">
                    <div class="btn-group me-2 mb-2 mb-sm-0">
                        <button type="button" class="btn btn-primary waves-light waves-effect"><i
                                class="fa fa-inbox"></i></button>
                        <button type="button" class="btn btn-primary waves-light waves-effect"><i
                                class="fa fa-exclamation-circle"></i></button>
                        <button type="button" class="btn btn-primary waves-light waves-effect"><i
                                class="far fa-trash-alt"></i></button>
                    </div>
                    <div class="btn-group me-2 mb-2 mb-sm-0">
                        <button type="button" class="btn btn-primary waves-light waves-effect dropdown-toggle"
                                data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-folder"></i> <i class="mdi mdi-chevron-down ms-1"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Updates</a>
                            <a class="dropdown-item" href="#">Social</a>
                            <a class="dropdown-item" href="#">Team Manage</a>
                        </div>
                    </div>
                    <div class="btn-group me-2 mb-2 mb-sm-0">
                        <button type="button" class="btn btn-primary waves-light waves-effect dropdown-toggle"
                                data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-tag"></i> <i class="mdi mdi-chevron-down ms-1"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Updates</a>
                            <a class="dropdown-item" href="#">Social</a>
                            <a class="dropdown-item" href="#">Team Manage</a>
                        </div>
                    </div>

                    <div class="btn-group me-2 mb-2 mb-sm-0">
                        <button type="button" class="btn btn-primary waves-light waves-effect dropdown-toggle"
                                data-bs-toggle="dropdown" aria-expanded="false">
                            More <i class="mdi mdi-dots-vertical ms-2"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Mark as Unread</a>
                            <a class="dropdown-item" href="#">Mark as Important</a>
                            <a class="dropdown-item" href="#">Add to Tasks</a>
                            <a class="dropdown-item" href="#">Add Star</a>
                            <a class="dropdown-item" href="#">Mute</a>
                        </div>
                    </div>
                </div>


                <div class="card-body">
                    <div class="d-flex mb-4">
                        <div class="flex-grow-1">
                            <h5 class="font-size-14 mt-1">Email du DEVIS</h5>
                            {{--<small class="text-muted">support@domain.com</small>--}}
                        </div>
                    </div>

                    <form>
                        <textarea class="form-control @error('content') is-invalid @enderror"
                                                  name="content"
                                                  id="ticketdesc-editor" rows="3"
                                                   required>
                                {!! $email->content  !!}
                        </textarea>
                    </form>
                    <a href="javascript: void(0);" class="btn btn-secondary waves-effect mt-4"><i
                            class="mdi mdi-reply"></i> Reply</a>
                </div>

            </div>
        </div>
        <!-- card -->

    </div>
    <!-- end Col-9 -->

</div>
