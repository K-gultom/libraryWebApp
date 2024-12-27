@extends('main')

@section('content')
    <h1>Ini Halaman Catalog</h1>
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
            }, {{ session('timeout', 1000) }});
        </script>
    @endif

    <section>
        <div class="conteiner p-2">
            <div class="row">
                @foreach ($infoCatalog as $item)
                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">{{ $item->judul }}</h5>
                          <p class="card-text">Pengarang: {{ $item->pengarang }}</p>
                          <p class="card-text">Penerbit: {{ $item->penerbit }}->{{ $item->tahun_terbit }}</p>
                          <form action="{{ route('checkout.keranjang') }}" method="post">
                            @csrf
                              {{-- <a href="#" class="btn btn-primary">Add To Cart</a> --}}
                              <input hidden type="text" name="id_order" value="{{ $item->id }}">

                              <button type="submit" class="btn btn-primary">Add to Cart</button>
                          </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection