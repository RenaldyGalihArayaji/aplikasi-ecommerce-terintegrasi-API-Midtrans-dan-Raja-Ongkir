@extends('landing.layout.index')

@section('content')

<div class="page-heading bg-light">
    <div class="container">
      <div class="row align-items-end text-center">
        <div class="col-lg-7 mx-auto">
          <h1>Cart</h1>  
          <p class="mb-4"><a href="{{ route('home')}}">Home</a> / <strong>Cart</strong></p>        
        </div>
      </div>
    </div>
  </div>

  

  <div class="container mt-5">

    <div class="row">
        <div class="col-md-12">
          <div class="site-blocks-table">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th class="product-thumbnail">Image</th>
                  <th class="product-name">Product</th>
                  <th >Price</th>
                  <th class="product-quantity">Quantity</th>
                  <th class="product-total">Total</th>
                  <th class="product-remove">Action</th>
                </tr>
              </thead>
              <tbody>
                  @php
                      $subtotal = 0;
                  @endphp
                  @foreach ($cart as $item)
                  <tr>
                    <td class="product-thumbnail">
                    <img src="{{ asset('storage/images_product/'. $item->product->image)}}" alt="Image" class="img-fluid" width="50">
                    </td>
                    <td class="product-name">
                    <h2 class="h5 text-black">{{ $item->product->name}}</h2>
                    </td>
                    <td>@currency($item->product->price_final)</td>
                    <td class="d-flex justify-content-center">
                      <form action="{{ route('cart.update', $item->id)}}" method="post">
                          @csrf
                          @method('put')
                          <input type="hidden" name="order_detail_id" value="{{ $item->id }}">
                          <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                          <div class="input-group" style="max-width: 120px;">
                              <div class="input-group-prepend">
                                  <button class="btn btn-outline-black js-btn-minus" type="button">&minus;</button>
                              </div>
                              <input type="text" class="form-control text-center" value="{{ $item->quantity}}" name="quantity"  aria-describedby="button-addon1" min="1">
                              <div class="input-group-append">
                                  <button class="btn btn-outline-black js-btn-plus" type="button">&plus;</button>
                              </div>
                          </div>
                  </td>
                  <td>@currency($item->sub_total)</td>
                  <td>
                      <button type="submit" class="btn btn-black btn-sm btn-block" >Update</button>
                    </form >
                    <form action="{{ route('cart.destroy', $item->id)}}" method="post">
                      @csrf
                      @method('delete')
                      <button type="submit" class="btn btn-black btn-sm confirm-delete">X</button>
                    </form>
                  </td>
                  </tr>

                  @php
                      $subtotal += $item->sub_total;
                  @endphp
                  @endforeach
              </tbody>
            </table>
          </div>
        </div>
    </div>

    <div class="row mb-5">
      <div class="col-md-6">
        <div class="row mb-5">
          <div class="col-md-6 mb-3 mb-md-0">
            <a  class="btn btn-outline-black btn-sm btn-block" href="{{ route('shop')}}">Continue Shopping</a>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="row justify-content-end">
          <div class="col-lg-7">
            <div class="row">
              <div class="col-md-12 border-bottom mb-5">
                <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <span class="text-black">Subtotal</span>
              </div>
              <div class="col-md-6 text-right">
                <strong class="text-black">@currency($subtotal)</strong>
              </div>
            </div>
            <form action="{{ route('cartToCheckout')}}" method="post">
            @csrf
              <div class="row">
                <div class="col-md-12">
                  <button type="submit" class="btn btn-black btn-lg py-3 btn-block" >Proceed To Checkout</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>

@endsection

