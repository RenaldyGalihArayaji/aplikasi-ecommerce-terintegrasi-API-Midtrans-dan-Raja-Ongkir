@extends('admin.layout.index')

@section('content')
    
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Category | <span class="text-secondary fs-5">Update</span></h1>
    </div>

    <div class="row">

      <!-- Area Chart -->
      <div class="col-xl-6 col-lg-6">
        <div class="card shadow mb-4">
          <!-- Card Header - Dropdown -->
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Update Data</h6>
            <a href="{{ route('category.index')}}" class="btn btn-danger btn-sm sm-auto">Back</a>
          </div>
          <!-- Card Body -->
          <div class="card-body">
                <form action="{{ route('category.update', $category->id)}}" method="post">
                @csrf
                @method('put')

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" value="{{ $category->name}}" name="name">
                  </div>
                  <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Update</button>
                  </div>
                </form>
          </div>
        </div>
      </div>

    </div>


</div>

@endsection