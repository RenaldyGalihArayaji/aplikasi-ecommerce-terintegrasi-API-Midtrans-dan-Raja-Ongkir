@extends('landing.layout.index')

@section('content')

  <div class="page-heading bg-light">
    <div class="container">
      <div class="row align-items-end text-center">
        <div class="col-lg-7 mx-auto">
          <h1>Confirmasi Payment</h1>  
          <p class="mb-4"><a href="{{ route('home')}}">Home</a> / <strong>Confirmasi </strong></p>        
        </div>
      </div>
    </div>
  </div>

  <div class="container mt-5">
    <div class="text-center mb-5">
      <h3>THANK YOU</h3>
      <p>ORDER HAS BEEN SUCCESSFULLY PLACED</p>
      <hr class="w-50">
      <p>{{ $dataCustomer->first_name }} {{ $dataCustomer->last_name }} </p>
      <p>({{$dataCustomer->postal_code }}) {{ $dataCustomer->address}}, {{ $dataCustomer->city->city_name}} , {{ $dataCustomer->province->province}}</p>
    </div>

    <div class="row">

      <div class="col-md-6 mb-3">
        <div class="p-3 p-lg-3 border">
          <h4 class="text-center">Order ID : {{ $transaksi->invoice }}</h4>
        </div>
      </div>

      <div class="col-md-6 mb-3">
        <div class="p-3 p-lg-3 border">
          <h4 class="text-center">Amount Paid : @currency($transaksi->grand_total)</h4>
        </div>
      </div>
      
    </div>
    
    <div class="row d-flex justify-content-center mb-5">
        <div class="col-6">
          <button type="submit" class="btn btn-black btn-lg py-3 btn-block" id="pay-button">Payment</button>
        </div>
    </div>
    <!-- </form> -->
  </div>

  @section('script')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function () {
            // SnapToken acquired from previous step
            snap.pay('{{ $transaksi->snap_token }}', {
                // Optional
                onSuccess: function (result) {
                    window.location.href = ' {{ route("info_order")}} ';
                },
                // Optional
                onPending: function (result) {
                    /* You may add your own js here, this is just an example */
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                },
                // Optional
                onError: function (result) {
                    /* You may add your own js here, this is just an example */
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                }
            });
        };
  </script>


@endsection

