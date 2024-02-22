@extends('admin.layout.index')

@section('content')
    
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Order | <span class="text-secondary fs-5">Update</span></h1>
    </div>

    <div class="row">

      <!-- Area Chart -->
      <div class="col-xl-6 col-lg-6">
        <div class="card shadow mb-4">
          <!-- Card Header - Dropdown -->
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Update Data</h6>
            <a href="{{ route('order.index')}}" class="btn btn-danger btn-sm sm-auto">Back</a>
          </div>
          <!-- Card Body -->
          <div class="card-body">
                <form action="{{ route('order.update', $transaksi->id)}}" method="post">
                    @csrf
                    @method('put')

                    <div class="mb-3">
                        <label for="number_track" class="form-label">Number Track</label>
                        <input type="text" name="number_track" id="number_track" class="form-control">
                   </div>

                    <div class="mb-3">
                        <label for="status_delivery" class="form-label">Status Delivery</label>
                         <select class="form-select" aria-label="Default select example" name="status_delivery" id="status_delivery">
                          <option value="process" {{ $transaksi->status_delivery == 'process' ? 'selected' : '' }}>Process</option>
                          <option value="shipping" {{ $transaksi->status_delivery == 'shipping' ? 'selected' : '' }}>Shipping</option>
                          <option value="completed" {{ $transaksi->status_delivery == 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
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