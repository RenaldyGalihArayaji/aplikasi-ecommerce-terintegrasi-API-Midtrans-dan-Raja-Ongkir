@extends('landing.layout.index')

@section('content')

<div class="page-heading bg-light">
    <div class="container">
      <div class="row align-items-end text-center">
        <div class="col-lg-7 mx-auto">
          <h1>My Order</h1>  
          <p class="mb-4"><a href="{{ route('home')}}">Home</a> / <a href="{{ route('info_order')}}">My Order</a> / <strong> Show</strong></p>        
        </div>
      </div>
    </div>
  </div>

  

  <div class="untree_co-section">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="p-4 p-lg-5 border">
            <div class="row ">
                <div class="col-md-12 text-center">
                    <img src="{{ asset('landing/images/logo.png')}}" alt="" width="100">
                    <h4 class="my-3"><strong>ORDER RECORD</strong></h4>
                    <h6>TOKO MALHEST</h6>
                </div>
            </div>
            <hr class="my-4" style="border-width: 5px;">
              <div class="row mt-5">

                <div class="col-md-3 text-right">
                  <h6 class="font-weight-bold"><span >{{ strtoupper($transaksi->invoice)}}</span></h6>
                  <h6 ><span >{{ date('d F Y', strtotime( strtoupper($transaksi->created_at))) }}</span></h6>
                  <h6 ><span >{{ strtoupper($dataCustomer->courier)}}</span></h6>
                  <h6 ><span >{{ strtoupper($transaksi->number_track)}}</span></h6>
                </div>

                <div class="col-md-12 mt-5">
                  <div class="table-responsive">
                    <table class="table table-striped mb-5">
                      <thead>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Postal Code</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>Province</th>
                      </thead>
                      <tbody>
                        <tr>
                          <td>{{ $dataCustomer->first_name }} {{ $dataCustomer->last_name }}</td>
                          <td>{{ $dataCustomer->email}}</td>
                          <td>{{ $dataCustomer->phone}}</td>
                          <td>{{ $dataCustomer->postal_code}}</td>
                          <td>{{ $dataCustomer->address}}</td>
                          <td>{{ $dataCustomer->city->city_name}}</td>
                          <td>{{ $dataCustomer->province->province}}</</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>

                <div class="col-md-12 mt-5">
                  <div class="table-responsive">
                    <table class="table table-striped mb-5">
                      <thead>
                        <th>#</th>
                        <th>Product</th>
                        <th>Note</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                      </thead>
                      <tbody>
                        @php
                            $subtotal = 0;
                        @endphp
                        @foreach ($order as $item)
                        <tr>
                          <td>{{ $loop->iteration}}</td>
                          <td>{{ $item->product->name}}</td>
                          <td>{{ $item->note}}</td>
                          <td>@currency($item->product->price)</td>
                          <td>{{ $item->quantity}}</td>
                          <td>@currency($item->sub_total)</td>
                        </tr>
                        @php
                            $subtotal += $item->sub_total;
                        @endphp
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>

                <div class="col-12">
                  <div class="float-right w-50">
                    <div class="row">
                      <div class="col-md-12 ">
                        <hr>
                        <h6 >Sub Total   <span class="float-right">@currency($subtotal)</span></h6>
                        <hr>
                        <h6>Shipping Cost   <span class="float-right">@currency($transaksi->shipping_cost)</span></h6>
                        <hr>
                        <h6 class="font-weight-bold">Grand Total   <span class="float-right">@currency($transaksi->grand_total)</span></h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>
      <!-- </form> -->
    </div>
  </div>
  
@endsection

