@extends('admin.layout.index')

@section('content')
    
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Shipping Address</h1>
    </div>

    <!-- Content Row -->

    <div class="row">

      <!-- Area Chart -->
      <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
          <!-- Card Header - Dropdown -->
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Table Shipping Address</h6>
            <a href="{{ route('shipping-address.create')}}" class="btn btn-primary ms-auto">Add Data</a>
          </div>
          <!-- Card Body -->
          <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Province</th>
                            <th>City</th>
                            <th>Address</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($shippingAddress as $item)
                            <tr>
                                <td>{{ $loop->iteration}}</td>
                                <td>{{ $item->province->province}}</td>
                                <td>{{ $item->city->city_name}}</td>
                                <td>{{ $item->address}}</td>
                                <td>{{ $item->status}}</td>
                                <td>
                                    <a href="{{ route('shipping-address.edit', $item->id)}}" class="btn btn-success btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>
                                    <form action="{{ route('shipping-address.destroy', $item->id)}}" method="post" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm confirm-delete"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
          </div>
        </div>
      </div>

    </div>
</div>


@endsection
