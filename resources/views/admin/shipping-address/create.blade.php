@extends('admin.layout.index')

@section('content')
    
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Shipping Address | <span class="text-secondary fs-5">Add</span></h1>
    </div>

    <div class="row">

      <!-- Area Chart -->
      <div class="col-xl-6 col-lg-6">
        <div class="card shadow mb-4">
          <!-- Card Header - Dropdown -->
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Add Data</h6>
            <a href="{{ route('shipping-address.index')}}" class="btn btn-danger btn-sm sm-auto">Back</a>
          </div>
          <!-- Card Body -->
          <div class="card-body">
                <form action="{{ route('shipping-address.store')}}" method="post">
                @csrf
                    <div class="mb-3">
                        <label for="province" class="form-label">Province<span class="text-danger">*</span></label>
                        <select id="province" name="province" class="form-control @error('province') is-invalid @enderror">
                            <option selected>Select a Province</option>  
                            @foreach ($provinces as $province)
                                <option value="{{ $province->id }}">{{ $province->province }}</option>
                            @endforeach    
                        </select>
                        @error('province')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="city" class="form-label">City<span class="text-danger">*</span></label>
                        <select id="city" name="city" class="form-control @error('city') is-invalid @enderror">
                            <option selected>Select a City</option>         
                        </select> 
                        @error('city')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Address<span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder="Street address">
                        @error('address')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                        @enderror
                    </div>

                  <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Save</button>
                  </div>
                </form>
          </div>
        </div>
      </div>

    </div>


</div>

@endsection