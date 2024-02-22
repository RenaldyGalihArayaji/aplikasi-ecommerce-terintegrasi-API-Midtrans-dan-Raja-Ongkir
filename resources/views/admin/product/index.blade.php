@extends('admin.layout.index')

@section('content')
    
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Product</h1>
    </div>

    <!-- Content Row -->

    <div class="row">

      <!-- Area Chart -->
      <div class="col-md-12">
        <div class="card shadow mb-4">
          <!-- Card Header - Dropdown -->
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Table Product</h6>
            <a href="{{ route('product.create')}}" class="btn btn-primary ms-auto">Add Data</a>
          </div>
          <!-- Card Body -->
          <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Start Price</th>
                            <th>Discount</th>
                            <th>Final Price</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Iterasi data kategori --}}
                        @foreach($product as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><img src="{{ asset('storage/images_product/'. $data->image )}}" alt="" width="40"></td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->category->name }}</td>
                                <td>@currency($data->price)</td>
                                <td>@percent($data->discount)</td>
                                <td>@currency($data->price_final)</td>
                                <td>{{ $data->stock }}</td>
                                <td>
                                  @if ($data->status == 'available')
                                    <button class="btn btn-info btn-sm">Available</button>
                                  @else
                                     <button class="btn btn-secondary btn-sm">Sold Out</button>
                                  @endif
                                </td>
                                <td>
                                    {{-- Tambahkan tombol aksi sesuai kebutuhan --}}
                                   <a href="{{ route('product.show', $data->id)}}" class="btn btn-warning btn-sm"><i class="fa-regular fa-eye"></i></a>
                                   <a href="{{ route('product.edit', $data->id)}}" class="btn btn-success btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>
                                   <form action="{{ route('product.destroy', $data->id)}}" method="post" class="d-inline">
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
