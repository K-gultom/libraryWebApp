@extends('main')


@section('content')
    <h2>Ini Halaman Category</h2>
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
                            }, {{ session('timeout', 3000) }});
                        </script>
                    @endif
                    <div class="card-header">
                        Form 
                    </div>
        
                    <div class="card-body">
                        <form action="" method="post">
                            @csrf
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="category" class="form-label">Type Category</label>
                                    <input type="text" class="form-control" name="category">
                                </div>
                                <div class="col mb-3">
                                    <label for="nomor_rak" class="form-label">Nomor Rak</label>
                                    <input type="number" class="form-control" name="nomor_rak">
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
                        <div class="card-header">Daftar Category</div>
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
                                        <th>Category</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data akan dimuat secara otomatis dengan AJAX -->

                                    @foreach ($getCategory as $item)
                                        <tr>
                                            <td>
                                                {{ (($getCategory->currentPage() - 1) * $getCategory->perPage()) + $loop->iteration }} 
                                            </td>
                                            <td>{{ $item->category }} -------Nomor Rak--> {{ ($item->nomor_rak) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $getCategory->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection