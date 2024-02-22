@extends('admin.layout.index')

@section('content')
    
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Orders</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$transaksi->count()}}</div>
                </div>
                <div class="col-auto">
                    <i class="fa-solid fa-paper-plane fa-2x text-gray-300"></i>
                </div>
                </div>
            </div>
            </div>
        </div>

          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Products</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $product}}</div>
                </div>
                <div class="col-auto">
                    <i class="fa-solid fa-bag-shopping fa-2x text-gray-300"></i>
                </div>
                </div>
            </div>
            </div>
        </div>

         <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Users</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $user}}</div>
                </div>
                <div class="col-auto">
                    <i class="fa-solid fa-user fa-2x text-gray-300"></i>
                </div>
                </div>
            </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Income</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                @php
                                    $grandtotal = 0;
                                    $finance = 0;
                                @endphp
        
                                @foreach ($transaksi as $item)
                                    @if ($item->status_payment == 'unpaid')
                                        @php
                                            $finance;
                                        @endphp
                                    @else
                                        @php
                                            $grandtotal += $item->grand_total;
                                        @endphp
                                    @endif
                                @endforeach
        
                                @if ($finance > 0)
                                    @currency($finance)
                                @else
                                    @currency($grandtotal)
                                @endif
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-credit-card fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

    </div>



</div>

@endsection