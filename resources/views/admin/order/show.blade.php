@extends('admin.layout.index')

@section('content')
    
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Order | <span class="text-secondary fs-5">Show</span></h1>
    </div>

    <div class="row mb-2">

        <div class="col-xl-12 col-lg-12">
          <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Order ID : {{ $transaksi->invoice}}</h6>
              <a href="{{ route('order.index')}}" class="btn btn-danger btn-sm sm-auto">Back</a>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="col-md-12">
                  <div class="row">

                    @php
                    $subtotal = 0;
                    @endphp
                    @foreach ($order as $item)
                    @php
                      $subtotal += $item->sub_total;
                    @endphp
                    @endforeach

                    <div class="col-md-4 mb-2">
                      <label for="order_date" class="form-label">Order Date</label>
                      <input type="text" class="form-control" id="order_date"  value="{{ date('d F Y', strtotime( strtoupper($transaksi->created_at))) }}" disabled>
                    </div>

                    <div class="col-md-4 mb-2">
                      <label for="status" class="form-label">Status Payment</label>
                      <input type="text" class="form-control" id="status"  value="{{ $transaksi->status_payment}}" disabled>
                    </div>

                    <div class="col-md-4 mb-2">
                      <label for="status" class="form-label">Status Delivery</label>
                      <input type="text" class="form-control" id="status"  value="{{ $transaksi->status_delivery}}" disabled>
                    </div>

                    <div class="col-md-3 mb-2">
                      <label for="shipping" class="form-label">Shipping By</label>
                      <input type="text" class="form-control" id="shipping"  value="{{ $dataCustomer->courier}}" disabled>
                    </div>

                    <div class="col-md-3 mb-2">
                      <label for="cart_total" class="form-label">Sub Total</label>
                      <input type="text" class="form-control" id="cart_total"  value="@currency($subtotal)" disabled>
                    </div>

                    <div class="col-md-3 mb-2">
                      <label for="shipping_cost" class="form-label">Shipping Cost</label>
                      <input type="text" class="form-control" id="shipping_cost"  value="@currency($transaksi->shipping_cost)" disabled>
                    </div>

                    <div class="col-md-3 mb-2">
                      <label for="grand_total" class="form-label">Grand Total</label>
                      <input type="text" class="form-control" id="grand_total"  value="@currency($transaksi->grand_total)" disabled>
                    </div>

                  </div>

              </div>
            </div>
          </div>
        </div>

        <!-- Billing Details -->
        <div class="col-xl-12 col-lg-12">
          <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Billing Details</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="col-md-12">
                  <div class="row">

                    <div class="col-md-4 mb-2">
                      <label for="first_name" class="form-label">First Name</label>
                      <input type="text" class="form-control" id="first_name"  value="{{ $dataCustomer->first_name}}" disabled>
                    </div>

                    <div class="col-md-4 mb-2">
                      <label for="last_name" class="form-label">Last Name</label>
                      <input type="text" class="form-control" id="last_name"  value="{{ $dataCustomer->last_name}}" disabled>
                    </div>

                    <div class="col-md-4 mb-2">
                      <label for="province" class="form-label">Province</label>
                      <input type="text" class="form-control" id="province"  value="{{ $dataCustomer->province->province}}" disabled>
                    </div>

                    <div class="col-md-4 mb-2">
                      <label for="province" class="form-label">City</label>
                      <input type="text" class="form-control" id="province"  value="{{ $dataCustomer->city->city_name}}" disabled>
                    </div>

                    <div class="col-md-4 mb-2">
                      <label for="address" class="form-label">Address</label>
                      <input type="text" class="form-control" id="address"  value="{{ $dataCustomer->address}}" disabled>
                    </div>

                    <div class="col-md-4 mb-2">
                      <label for="address" class="form-label">Postal Code</label>
                      <input type="text" class="form-control" id="address"  value="{{ $dataCustomer->postal_code}}" disabled>
                    </div>

                    <div class="col-md-4 mb-2">
                      <label for="email" class="form-label">Email</label>
                      <input type="text" class="form-control" id="email"  value="{{ $dataCustomer->email}}" disabled>
                    </div>

                    <div class="col-md-4 mb-2">
                      <label for="phone" class="form-label">Phone</label>
                      <input type="text" class="form-control" id="phone"  value="{{ $dataCustomer->phone}}" disabled>
                    </div>

                    <div class="col-md-4 mb-2">
                      <label for="number_track" class="form-label">Number Track</label>
                      <input type="text" class="form-control" id="number_track"  value="{{ $transaksi->number_track}}" disabled>
                    </div>

                  </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Items -->
        <div class="col-xl-12 col-lg-12">
          <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Items</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="responsive">
                    <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                                <th>Note</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><img src="{{ asset('storage/images_product/'. $item->product->image )}}" alt="" width="40"></td>
                                    <td>{{ $item->product->name }}</td>
                                    <td>@currency($item->product->price)</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>@currency($item->sub_total)</td>
                                    <td>{{ $item->note }}</td>
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