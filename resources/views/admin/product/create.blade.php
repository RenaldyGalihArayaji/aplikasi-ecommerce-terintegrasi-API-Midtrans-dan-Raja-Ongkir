@extends('admin.layout.index')

@section('content')
    
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Product | <span class="text-secondary fs-5">Add</span></h1>
    </div>

    <div class="row">

      <!-- Area Chart -->
      <div class="col-md-10">
        <div class="card shadow mb-4">
          <!-- Card Header - Dropdown -->
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Add Data</h6>
            <a href="{{ route('product.index')}}" class="btn btn-danger btn-sm sm-auto">Back</a>
          </div>
          <!-- Card Body -->
          <div class="card-body">
            <form class="row g-3" action="{{ route('product.store')}}" method="POST" enctype="multipart/form-data">
              @csrf
              
              <div class="col-md-6">
                <label for="name" class="form-label">Name Product<span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Your Enter Name">
                @error('name')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>

              <div class="col-md-6">
                <label for="category_id" class="form-label">Category<span class="text-danger">*</span></label>
                <select id="category_id" class="form-select @error('category_id') is-invalid @enderror" name="category_id">
                  <option selected>Select a Category</option>
                  @foreach ($category as $item)
                  <option value="{{ $item->id }}">{{ $item->name }}</option>
                  @endforeach
                </select>
                @error('category_id')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>

              <div class="col-md-6">
                <label for="price" class="form-label">Price<span class="text-danger">*</span></label>
                <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" placeholder="Your Enter Price">
                @error('price')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>

              <div class="col-md-6">
                <label for="stock" class="form-label">Stock<span class="text-danger">*</span></label>
                <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" placeholder="Your Enter Stock">
                @error('stock')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>

              <div class="col-md-6">
                <label for="weight" class="form-label">Weight Product<span class="text-danger">*(gram)</span></label>
                <input type="number" class="form-control @error('weight') is-invalid @enderror" id="weight" name="weight" placeholder="Your Enter Weight">
                @error('weight')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>

              <div class="col-md-6">
                <label for="image" class="form-label">Image<span class="text-danger">*(Maximal 2 Mb)</span></label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" >
                @error('image')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>

              <div class="col-md-12">
                <label for="description" class="form-label">Description<span class="text-danger">*</span></label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" placeholder="Your Enter Description" name="description"></textarea>
                @error('description')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            
              <div class="col-12 ">
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>

    </div>


</div>

@endsection
