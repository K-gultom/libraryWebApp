@extends('main')

@section('content')
    
    <div class="container mt-3">
        <div class="row">
            <div class="col-6 offset-3">
                <div class="card">
                    <div class="card-header">
                        Login
                    </div>
                    <div class="card-body">
                        <form class="pt-3" method="POST">
                            @csrf
                            <div class="row my-2">
                                <div class="col">
                                    <div class="form-group">
                                        <input type="email" value="{{old('email')}}" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Username">
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @endif
                                      </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                              <button class="btn btn-primary">SIGN IN</button>
                            </div>
                            
                            {{-- <div class="text-center mt-4 fw-light">
                              Don't have an account? <a href="#" class="text-primary">Create</a>
                            </div> --}}
                          </form>
                    </div>
                </div>
            </div>  
        </div>
    </div>
@endsection