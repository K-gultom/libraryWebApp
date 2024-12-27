@extends('main')


@section('content')
    <h2>Ini Halaman User</h2>
        <div class="row mb-3">
            <div class="col-6 offset-3">
                <div class="card">
                    @if (Session::has('message'))
                        <div class="alert alert-success" id="flash-message">
                            <strong>
                                {{Session::get('message')}}
                            </strong>
                        </div>
                        <script>
                            setTimeout(function () {
                                document
                                    .getElementById('flash-message')
                                    .style
                                    .display = 'none';
                            }, {{ session('timeout', 5000) }});
                        </script>
                    @endif
                    <div class="card-header">
                        Form 
                    </div>
        
                    <div class="card-body">
                        <form action="" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label for="name" class="form-label">Your Full Name</label>
                                    <input type="text" class="form-control" name="username">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label for="email" class="form-label">Email address</label>
                                    <input type="email" class="form-control" name="email">
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="password" class="form-label">Type Your Password Here</label>
                                    <input type="password" class="form-control" name="password">
                                    <input readonly type="text" class="form-control" name="role" value="user">
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Save Information</button>
                            <button type="reset" class="btn btn-warning">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="container mb-5">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Daftar User</div>
                        <div class="card-body">
                            {{-- {{ $user->links() }} --}}
                            <div class="row my-2 d-flex">
                                <div class="col-4 ms-auto d-flex align-items-center">
                                    <form action="" class="d-flex w-100">
                                        <input type="text" class="form-control me-2" placeholder="search">
                                        <button type="submit" class="btn btn-primary">search</button>
                                    </form>
                                </div>
                            </div>
                            
                            <!-- Tabel Data -->
                            <table id="tbl_list" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Email</th>
                                        <th>Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data akan dimuat secara otomatis dengan AJAX -->

                                    @foreach ($user as $item)
                                        <tr>
                                            <td>
                                                {{ (($user->currentPage() - 1) * $user->perPage()) + $loop->iteration }} 
                                            </td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->name }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $user->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        @push('scripts')
        <script>
            $(document).ready(function() {
                // Inisialisasi DataTables
                var table = $('#tbl_list').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ url('/user/data') }}', // Endpoint untuk data AJAX
                    columns: [
                        { data: 'id', name: 'id' },
                        { data: 'email', name: 'email' },
                        { data: 'name', name: 'name' },
                    ]
                });
    
                // Pencarian langsung
                $('#tbl_list_filter input').on('keyup', function() {
                    table.search(this.value).draw();
                });

                error: function(xhr, error, code) {
                    console.log(xhr.responseText); // Debugging response jika ada error
                }
            });
        </script>
        @endpush
        
@endsection