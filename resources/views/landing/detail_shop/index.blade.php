@extends('landing.layout.index')
@section('content')

<div class="page-heading bg-light">
    <div class="container">
      <div class="row align-items-end text-center">
        <div class="col-lg-7 mx-auto">
          <h1>Detail Product</h1>  
          <p class="mb-4"><a href="{{ route('home')}}">Home</a> / <strong>Detail</strong></p>        
        </div>
      </div>
    </div>
  </div>


    <div class="untree_co-section">
        <div class="container">
            <div class="row justify-content-between mb-5">
                <div class="col-md-6 text-center" data-aos="fade-up" data-aos-delay="400">
                    <img src="{{ asset('storage/images_product/'. $data->image)}}" alt="Image" class="rounded" width="80%">
                </div>
                <div class="col-md-6">
                <h2 class="line-bottom mb-4" data-aos="fade-up" data-aos-delay="0">{{ $data->name}}</h2>
                <p data-aos="fade-up" data-aos-delay="100">{{ $data->short_description}}</p>
                <ul class="list-unstyled ul-check mb-5 primary" data-aos="fade-up" data-aos-delay="200">
                    <li>Category : {{ $data->category->name}}</li>
                    @if ($data->discount > 0)
                    <li>Price : <del>@currency($data->price)</del> / <span>@currency($data->price_final)</span></li>
                    @else
                    <li>Price : @currency($data->price_final)</li>
                    @endif
                    <li>Stock : {{ $data->stock}}</li>
                    <li>Weight : @formatGram($data->weight)</li>
                    @if ($data->status == 'soldout')
                    <li>Status : <strong>Slod Out</strong></li>
                    @else
                    <li>Status : <strong>Available</strong></li>
                    @endif
                </ul>

                <p data-aos="fade-up" data-aos-delay="200">
                    <form action="{{ route('add_cart')}}" method="post">
                        @csrf
                        <input type="hidden" name="product_id" value="{{$data->id}}">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" id="quantity" placeholder="Jumlah Produk" min="1">
                                @error('quantity')
                                    <div class="invalid-feedback">
                                        {{ $message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="note" class="form-label">Note</label>
                                <input type="text" class="form-control" name="note" placeholder="Optional">
                            </div>
                        </div>
                        @if ($data->stock != 0)
                            @if (Auth::user())
                                <button type="submit" class="btn btn-black">Add To Cart</button>
                            @else
                            <a href="{{ route('login')}}" class="btn btn-black">Add To Cart</a>
                            @endif
                        @endif
                        
                    </form>
                </p>
            </div>
            <div class="row mt-5 px-3">
                <div class="col-md-12 ">
                    <h4 class="line-bottom mb-4" data-aos="fade-up" data-aos-delay="0">Description</h4>
                    <p data-aos="fade-up" data-aos-delay="100">{!! htmlspecialchars_decode($data->description) !!}</p>
                </div>
            </div>
        </div>
    </div> 

@endsection
