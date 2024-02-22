@extends('admin.layout.index')
@section('content')
    
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Product | <span class="text-secondary fs-5">Show</span></h1>
    </div>

    <div class="row">

      <!-- Area Chart -->
      <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
          <!-- Card Header - Dropdown -->
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Show Data</h6>
            <a href="{{ route('product.index')}}" class="btn btn-danger btn-sm sm-auto">Back</a>
          </div>
          <!-- Card Body -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-4">
                <div class="image text-center">
                  <img src="{{ asset('storage/images_product/'. $product->image )}}" alt="" class="img-thumbnail">
                </div>
              </div>
              <div class="col-md-8">
                <div class="row">
  
                  <div class="col-md-6 mb-2">
                    <label for="name" class="form-label">Name Product</label>
                    <input type="text" class="form-control" id="name"  value="{{ $product->name}}" disabled>
                  </div>
  
                  <div class="col-md-6 mb-2">
                    <label for="category" class="form-label">Category</label>
                    <input type="text" class="form-control" id="category"  value="{{ $product->category->name}}" disabled>
                  </div>
  
                  <div class="col-md-6 mb-2">
                    <label for="harga" class="form-label">Price</label>
                    <input type="text" class="form-control" id="harga"  value="@currency($product->price)" disabled>
                  </div>

                  <div class="col-md-6 mb-2">
                    <label for="harga" class="form-label">Discount</label>
                    <input type="text" class="form-control" id="harga"  value="@percent($product->discount)" disabled>
                  </div>

                  <div class="col-md-6 mb-2">
                    <label for="harga" class="form-label">Price Final</label>
                    <input type="text" class="form-control" id="harga"  value="@currency($product->price_final)" disabled>
                  </div>
  
                  <div class="col-md-6 mb-2">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="text" class="form-control" id="stock"  value="{{ $product->stock}}" disabled>
                  </div>
  
                  <div class="col-md-6 mb-2">
                    <label for="weight" class="form-label">Weight Product</label>
                    <input type="text" class="form-control" id="weight"  value="@formatGram($product->weight)" disabled>
                  </div>
  
                  <div class="col-md-6 mb-2">
                    <label for="status" class="form-label">Status</label>
                    <input type="text" class="form-control" id="status"  value="{{ $product->status}}" disabled>
                  </div>

                  <div class="col-md-12 mb-2">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" disabled>{{ $product->description}}</textarea>
                  </div>
                

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>


</div>

@endsection