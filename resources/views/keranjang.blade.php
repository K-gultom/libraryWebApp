@extends('main')

@section('content')
    <div class="container mt-2 mb-3">
        <h3 class="col-9 offset-1">My Cart</h3>

        @foreach ($groupedData as $bookId => $items)
            <div class="row mb-2">
                <div class="col-9 offset-1">
                    <div class="card p-2">
                        <div class="row g-0">
                            <div class="col-6">
                                <div class="row">
                                    <div class="col bg- g-0 text-end">
                                        <img src="{{ url('assets/images/img.png') }}" 
                                        class="card-img-top img-thumbnail" 
                                        style="width: 150px; height: auto; object-fit: cover;" 
                                        alt="Gambar Buku">
                                    </div>
                                    <div class="col">
                                        <div class="card-body">
                                            <a href="" class="card-title text-decoration-none"><h5>{{ $items[0]->getBook->judul }}</h5></a>
                                            <p class="card-text">Pengarang: {{ $items[0]->getBook->pengarang }}</p>
                                            <p class="card-text">Penerbit: {{ $items[0]->getBook->penerbit }} -> {{ $items[0]->getBook->tahun_terbit }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-5 d-flex text-center justify-content-end align-items-center bg-">
                                <div>
                                    <p class="card-text mx-5">Jumlah: {{ count($items) }}</p>
                                </div>

                                {{-- Fitur Add Keranjang --}}
                                {{-- <form action="{{ route('addCard.checkout') }}" method="post">
                                    @csrf
                                    <input hidden type="text" name="id_order" value="{{ $items[0]->getBook->id }}">
    
                                    <button type="submit" class="btn btn-primary mx-3"><i class="bi bi-plus-lg"></i></button>
                                </form> --}}

                                <form action="{{ route('cancel.checkout') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id_order_cancel" value="{{ $items[0]->id }}">
                                    <button type="submit" class="btn btn-danger"><i class="bi bi-dash-lg"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
