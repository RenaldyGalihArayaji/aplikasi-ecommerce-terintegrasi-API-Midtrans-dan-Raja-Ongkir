@extends('admin.layout.index')

@section('content')
    
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Profil</h1>
    </div>

    <div class="row">

      <!-- Area Chart -->
      <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
          <!-- Card Header - Dropdown -->
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Profil</h6>
            <a href="{{ route('change_password_admin')}}" class="btn btn-danger btn-sm sm-auto">Change Password</a>
          </div>
          <!-- Card Body -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">

                <div class="image text-center mb-3">
                  <img src="{{ asset('storage/images_profil/'. Auth::user()->image )}}" alt=""  class=" img-thumbnail">
                </div>

              </div>

              <div class="col-md-6">

                <form action="{{ route('profilAdmin')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
    
                    <div class="mb-2">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"  value="{{ Auth::user()->name}}" name="name">
                        @error('name')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                        @enderror
                    </div>
      
                    <div class="mb-2">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"  value="{{ Auth::user()->email}}" name="email">
                        @error('email')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                        @enderror
                    </div>
      
                    <div class="mb-2">
                        <label for="status" class="form-label">Status</label>
                        <input type="text" class="form-control " id="status"  value="{{ Auth::user()->role}}" disabled>
                    </div>
      
                    <div class="mb-2">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"  value="{{ Auth::user()->phone}}" name="phone">
                        @error('phone')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                        @enderror
                    </div>   
                    
                    <div class="mb-2">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" >
                        @error('image')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                        @enderror
                    </div> 
    
                    <button type="submit" class="btn btn-primary">Update</button>
                    </form>
  
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>


</div>

@endsection