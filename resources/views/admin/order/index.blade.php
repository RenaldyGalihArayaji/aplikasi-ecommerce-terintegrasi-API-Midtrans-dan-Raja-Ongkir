@extends('admin.layout.index')

@section('content')
    
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Orders</h1>
    </div>

    <!-- Content Row -->

    <div class="row">

      <!-- Area Chart -->
      <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
          <!-- Card Header - Dropdown -->
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Table Orders</h6>
          </div>
          <!-- Card Body -->
          <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Invoice</th>
                            <th>Amount</th>
                            <th>Status Payment</th>
                            <th>Status Delivery</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Iterasi data kategori --}}
                        @foreach($transaksi as $item)
                        <tr>
                            <td>{{ $loop->iteration}}</td>
                            <td>{{ $item->invoice}}</td>
                            <td>@currency($item->grand_total)</td>
                            <td>
                                @if($item->status_payment == 'unpaid')
                                    <span class="btn btn-danger btn-sm">UNPAID</span>
                                @endif
                                @if($item->status_payment == 'paid')
                                    <span class="btn btn-info btn-sm">PAID</span>
                                @endif
                            </td>
                           
                            <td>
                                @if($item->status_delivery == 'process')
                                <span class="btn btn-warning btn-sm">PROCESS</span>
                                @endif
                                @if($item->status_delivery == 'shipping')
                                    <span class="btn btn-primary btn-sm">SHIPPING</span>
                                @endif
                                @if($item->status_delivery == 'completed')
                                    <span class="btn btn-success btn-sm">COMPLETED</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('order.show', $item->id)}}" class="btn btn-warning btn-sm"><i class="fa-regular fa-eye"></i></a>
                                <a href="{{ route('order.edit', $item->id)}}" class="btn btn-success btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>
                                <form action="{{ route('order.destroy', $item->id)}}" method="post" class="d-inline">
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
