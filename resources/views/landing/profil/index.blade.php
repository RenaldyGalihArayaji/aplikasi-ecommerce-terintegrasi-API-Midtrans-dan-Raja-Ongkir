@extends('landing.layout.index')
@section('content')

<div class="page-heading bg-light">
    <div class="container">
      <div class="row align-items-end text-center">
        <div class="col-lg-7 mx-auto">
          <h1>My Profil</h1>  
          <p class="mb-4"><a href="{{ route('home')}}">Home</a> / <strong>Profil</strong></p>        
        </div>
      </div>
    </div>
  </div>


    <div class="untree_co-section">
        <div class="container">
            <div class="row justify-content-between mb-5">
                <div class="col-md-6 mb-5" data-aos="fade-up" data-aos-delay="400">

                    <div class="col-12 mb-3">
                        <h4>Data Profil</h4>
                    </div>
                    <hr>
                    <form action="{{ route('profilUser')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="mb-3 text-center">
                            <img src="{{ asset('storage/images_profil/'. Auth::user()->image)}}" alt="Image" class="rounded " width="40%">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ Auth::user()->name}}">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" name="email" id="email" value="{{ Auth::user()->email}}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" name="phone" id="phone" value="{{ Auth::user()->phone}}">
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Foto</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image" >
                            @error('image')
                                <div class="invalid-feedback">
                                    {{ $message}}
                                </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-black">Perbarui</button>
                    </form>
                </div>
                <div class="col-md-6 px-3">

                    <div class="col-12 ">
                        <h4>Ubah Password</h4>
                    </div>
                    <hr>
                   <form action="{{ route('change_password_user')}}" method="post">
                    @csrf
                    @method('put')
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Password Lama</label>
                        <input type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" id="current_password" >
                        @error('current_password')
                            <div class="invalid-feedback">
                                {{ $message}}
                            </div>
                         @enderror
                    </div>
                    <div class="mb-3">
                        <label for="new_password" class="form-label">Password Baru</label>
                        <input type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" id="new_password" >
                        @error('new_password')
                            <div class="invalid-feedback">
                                {{ $message}}
                            </div>
                         @enderror
                    </div>
                    <div class="mb-3">
                        <label for="confirmasi_password" class="form-label">Konfirmasi Password Baru</label>
                        <input type="password" class="form-control" name="confirmasi_password" id="confirmasi_password" >
                    </div>
                    
                    <button type="submit" class="btn btn-black">Ubah</button>
                   </form>
                </div>
            </div>
        </div>
    </div> <!-- /.untree_co-section -->

@endsection
