@extends('admin.layout.index')

@section('content')
    
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Profil</h1>
    </div>

    <div class="row">

      <!-- Area Chart -->
      <div class="col-xl-6 col-lg-6">
        <div class="card shadow mb-4">
          <!-- Card Header - Dropdown -->
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Change Password</h6>
            <a href="{{ route('dashboard')}}" class="btn btn-danger btn-sm sm-auto">Back</a>
          </div>
          <!-- Card Body -->
          <div class="card-body">
            <div class="row">

                <form action="{{ route('change_password_admin')}}" method="post" >
                    @csrf
                    @method('put')

                    <div class="mb-2">
                        <label for="current_password" class="form-label">Current Password</label>
                        <input type="password" class="form-control  @error('current_password') is-invalid @enderror" id="current_password" name="current_password" >
                        @error('current_password')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                        @enderror
                    </div>
    
                    <div class="mb-2">
                        <label for="new_password" class="form-label">New Password</label>
                        <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" name="new_password" >
                        @error('new_password')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                        @enderror
                    </div>
    
                    <div class="mb-2">
                        <label for="confirmasi_password" class="form-label">ConfirmasiPassword</label>
                        <input type="password" class="form-control  @error('confirmasi_password') is-invalid @enderror" id="confirmasi_password" name="confirmasi_password" >
                        @error('confirmasi_password')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Change</button>
                </form>

            </div>
          </div>
        </div>
      </div>

    </div>


</div>

@endsection