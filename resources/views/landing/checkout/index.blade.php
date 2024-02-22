@extends('landing.layout.index')

@section('content')

<div class="page-heading bg-light">
    <div class="container">
      <div class="row align-items-end text-center">
        <div class="col-lg-7 mx-auto">
          <h1>Checkout</h1>  
          <p class="mb-4"><a href="{{ route('home')}}">Home</a> / <strong>Checkout</strong></p>        
        </div>
      </div>
    </div>
  </div>

  



  <div class="untree_co-section">
    <div class="container">
      <div class="row">

        <div class="col-md-6 mb-5 mb-md-0">
          <h2 class="h3 mb-3 text-black">Billing Details</h2>
          <div class="p-3 p-lg-5 border">

            <form action="{{ route('data_customer') }}" method="post">
              @csrf
              <div class="form-group row">
                <div class="col-md-6">
                  <label for="first_name" class="text-black">First Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="first_name" name="first_name">
                </div>
                <div class="col-md-6">
                  <label for="last_name" class="text-black">Last Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="last_name" name="last_name">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <label for="province" class="text-black">Province <span class="text-danger">*</span></label>
                  <select id="province" name="province" class="form-control">
                      <option selected>Select a Province</option>  
                      @foreach ($provinces as $province)
                          <option value="{{ $province->id }}">{{ $province->province }}</option>
                      @endforeach    
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <label for="city" class="text-black">City <span class="text-danger">*</span></label>
                  <select id="city" name="city" class="form-control">
                      <option selected>Select a City</option>         
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <label for="address" class="text-black">Address <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="address" name="address" placeholder="Street address">
                </div>
              </div>

              <div class="form-group row ">
                <div class="col-md-6">
                  <label for="email" class="text-black">Email Address <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="email" name="email" value="{{ Auth::user()->email}}" disabled>
                </div>
                <div class="col-md-6">
                  <label for="phone" class="text-black">Phone <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number">
                </div>
              </div>

              <div class="form-group row ">
                <div class="col-md-6">
                  <label for="postal_code" class="text-black">Postal Code <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="postal_code" name="postal_code">
                </div>
                <div class="col-md-6">
                  <label for="courier" class="text-black">Select a Courier <span class="text-danger">*</span></label>
                  <select id="courier" name="courier" class="form-control">
                      <option selected>Select a Courier</option>
                      <option value="jne">JNE</option>      
                      <option value="pos">Pos Indonesia</option>      
                  </select>
                </div>
              </div>

              <div class="form-group">
                <button class="btn btn-black btn-lg py-3 btn-block" type="submit" >Send</button>
              </div>
            </form>

          </div>
        </div>

        <div class="col-md-6">
          <div class="row mb-3">
            <div class="col-md-12">
              <h2 class="h3 mb-3 text-black">Your Order</h2>
              <div class="p-3 p-lg-5 border">
                <table class="table site-block-order-table mb-2">
                  <thead>
                    <th>Product</th>
                    <th>Total</th>
                  </thead>
                  <tbody>
                    @php
                        $ongkir = session('ongkir', 0);
                        $subtotal= 0;
                        $orderTotal = 0;
                    @endphp
                    @foreach ($orders as $order)
                      <tr>
                          <td>{{ $order->product->name }} <strong class="mx-2">x</strong>{{ $order->quantity }}</td>
                          <td>@currency($order->sub_total)</td>
                      </tr>
                      @php
                          $subtotal += $order->sub_total ;
                          $orderTotal = $subtotal + $ongkir;
                      @endphp
                  @endforeach

                    <tr>
                      <td class="text-black font-weight-bold"><strong>Cart Subtotal</strong></td>
                      <td class="text-black">@currency($subtotal)</td>
                    </tr>
                    <tr>
                      <td class="text-black font-weight-bold"><strong>Shipping Cost</strong></td>
                      <td class="text-black" id="shippingCost">@currency($ongkir)</td>
                  </tr>
                    <tr>
                      <td class="text-black font-weight-bold"><strong>Order Total</strong></td>
                      <td class="text-black font-weight-bold"><strong>@currency($orderTotal)</strong></td>
                    </tr>
                  </tbody>
                </table>

                {{-- Payment Method --}}
               @if ($cekongkir != '')
                    <div class="row mb-3">
                        @forelse ($cekongkir as $item)
                            <div class="col-lg-4 col-md-4 col-ms-4 mb-2">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6 class="card-title">{{ $item['service']}}</h6>
                                        <p class="card-text">@currency($item['cost'][0]['value'])</p>
                                        <p class="card-text">{{ $item['cost'][0]['etd']}} Day</p>
                                        <form action="{{ route('cekOngkir')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="ongkir" value="{{ $item['cost'][0]['value'] }}">
                                            <button class="btn btn-primary btn-sm" type="submit">Add</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>No shipping options available.</p>
                        @endforelse
                    </div>
                @endif

                <form action="{{ route('prosessToTransaksi')}}" method="post">
                  @csrf
                  <div class="form-group">
                    <button class="btn btn-black btn-lg py-3 btn-block" type="submit">Place Order</button>
                  </div>
                </form>

              </div>
            </div>
          </div>

        </div>
      </div>
      <!-- </form> -->
    </div>
  </div>

@endsection

