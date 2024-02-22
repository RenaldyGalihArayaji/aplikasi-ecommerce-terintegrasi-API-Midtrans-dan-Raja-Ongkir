@extends('admin.layout.index')

@section('content')
    
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Product | <span class="text-secondary fs-5">Update</span></h1>
    </div>

    <div class="row">

      <!-- Area Chart -->
      <div class="col-xl-10 col-lg-10">
        <div class="card shadow mb-4">
          <!-- Card Header - Dropdown -->
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Update Data</h6>
            <a href="{{ route('product.index')}}" class="btn btn-danger btn-sm sm-auto">Back</a>
          </div>
          <!-- Card Body -->
          <div class="card-body">
            <form class="row g-3" action="{{ route('product.update', $product->id)}}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('put')

              <div class="col-md-6">
                <label for="name" class="form-label">Name Product</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $product->name}}">
                @error('name')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>

              <div class="col-md-6">
                <label for="category_id" class="form-label">category</label>
                <select id="category_id" class="form-select @error('category_id') is-invalid @enderror" name="category_id">
                  <option value="{{ $product->category->id }}">{{ $product->category->name }}</option>
                  @foreach ($category as $a)
                  <option value="{{ $a->id }}">{{ $a->name }}</option>
                  @endforeach
                </select>
                @error('category_id')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>

              <div class="col-md-4">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price"  value="{{ $product->price}}">
                @error('price')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>

              <div class="col-md-4">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock"  value="{{ $product->stock}}">
                @error('stock')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>

              <div class="col-md-4">
                <label for="discount" class="form-label">Discount</label>
                <input type="number" max="100" min="0" class="form-control @error('discount') is-invalid @enderror" id="discount" name="discount"  value="{{ $product->discount}}">
                @error('discount')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>

              <div class="col-md-4">
                <label for="weight" class="form-label">Weight</label>
                <input type="number" class="form-control @error('weight') is-invalid @enderror" id="weight" name="weight"  value="{{ $product->weight}}">
                @error('weight')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>

              <div class="col-md-4">
                <label for="status" class="form-label">Status</label>
                <select id="status" class="form-select @error('status') is-invalid @enderror" name="status">
                  <option value="available" {{ $product->status == 'available' ? 'selected' : '' }}>Available</option>
                  <option value="soldout" {{ $product->status == 'soldout' ? 'selected' : '' }}>Sold Out</option>
                </select>
                @error('status')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>

              <div class="col-md-4">
                <label for="image" class="form-label">Image</label>
                <img src="{{ asset('storage/images_product/'. $product->image )}}" alt="" width="30">
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" >
                @error('image')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>

              <div class="col-md-12">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description"   name="description">{{ $product->description}}</textarea>
                @error('description')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            
              <div class="col-12 ">
                <button type="submit" class="btn btn-primary">Update</button>
              </div>
            </form>
          </div>
        </div>
      </div>

    </div>


</div>

@endsection