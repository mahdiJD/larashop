    @include('admin.layouts.sidbar',[$page])
        <div class="main-content">
            <main class="py-5">
            <div class="container">
                <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-title">
                        <div class="d-flex align-items-center">
                            <h2 class="mb-0">All Contacts
                                @if(request()->query('trash'))
                                    <small>(In Trash)</small>
                                @endif
                            </h2>
                            <div class="ml-auto">
                            <a href="#" class="btn btn-success"><i class="fa fa-plus-circle"></i> Add New</a>
                            </div>
                        </div>
                        </div>
                    <div class="card-body">
                        @if($message = session('message'))
                            <div class="alert alert-success">{{$message}}
                                @if($undoRoute = session('undoRoute'))
                                    <form action="{{$undoRoute}}" method="POST" style="display: inline">
                                    @csrf
                                    @method('delete')
                                        <button class="btn btn-warning">Undo</button>
                                    </form>
                                @endif
                            </div>
                        @endif
                        <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">{!! sortable("First Name",'first_name') !!}</th>
                            <th scope="col">{!! sortable("Last Name") !!}</th>
                            <th scope="col">{!! sortable("Email") !!}</th>
                            <th scope="col">Company</th>
                            <th scope="col">Actions</th>
                            </tr>
                        </thead>


                            <tbody>

                            @php
                                $showTrashButton = request()->query('trash') ? true : false;
                            @endphp
                        @forelse($users as $index => $user)
                                @include('admin.layouts._user_row', ['user'=> $user, 'index' => $index])
                            @empty
                                @include('admin.layouts._empty_contact')
                            @endforelse
                        </tbody>
                        </table>
                        {{ $users->withQueryString()->links() }}
                    </div>
                    </div>
                </div>
                </div>
            </div>
            </main>
        </div>
    </body>
</html>