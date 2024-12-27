@extends('main')


@section('content')
    <h2>Ini Halaman Book</h2>
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
                            <div class="row mb-4">
                                <div class="col-6">
                                    <select name="category_id" id="" class="form-control">
                                        <option value="">Choose Category</option>
                                        @foreach ($getCategory as $item)
                                            <option value="{{ $item->id }}">{{ $item->category }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="judul" class="form-label">Name Book</label>
                                    <input type="text" class="form-control" name="judul">
                                </div>
                                <div class="col mb-3">
                                    <label for="pengarang" class="form-label">Pengarang</label>
                                    <input type="text" class="form-control" name="pengarang">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="penerbit" class="form-label">Penerbit</label>
                                    <input type="text" class="form-control" name="penerbit">
                                </div>
                                <div class="col mb-3">
                                    <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                                    <select class="form-control" name="tahun_terbit">
                                        @php
                                            $currentYear = date('Y');
                                            $startYear = 1800;
                                        @endphp
                                
                                        @for ($year = $currentYear; $year >= $startYear; $year--)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @endfor
                                    </select>
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
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>judul</th>
                                        <th>pengarang</th>
                                        <th>penerbit</th>
                                        <th>tahun_terbit</th>
                                        <th>Category</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data akan dimuat secara otomatis dengan AJAX -->
                                    @foreach ($getBookInfo as $item)
                                        <tr>
                                            <td class="text-center">
                                                {{ (($getBookInfo->currentPage() - 1) * $getBookInfo->perPage()) + $loop->iteration }} 
                                            </td>
                                            <td>{{ $item->judul }}</td>
                                            <td>{{ $item->pengarang }}</td>
                                            <td>{{ $item->penerbit }}</td>
                                            <td class="text-center">{{ $item->tahun_terbit }}</td>
                                            <td>{{ $item->getCategory->category }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $getBookInfo->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection