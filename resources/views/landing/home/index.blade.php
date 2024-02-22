@extends('landing.layout.index')

@section('content')

<div class="owl-carousel owl-single home-slider">
        @foreach ($slide as $item)
        @if ($item->status === 'active')
        <div class="item">
            <div class="untree_co-hero" style="background-image: url('{{ asset('storage/images_slide/'. $item->image)}}');">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6">

                            <h1 class="mb-4 heading" data-aos="fade-up" data-aos-delay="100">{{ $item->caption}}</h1>
                            <div class="mb-5 text-white desc mx-auto" data-aos="fade-up" data-aos-delay="200">
                            </div>
                            @if ($item->caption !== null)
                            <p class="mb-0" data-aos="fade-up" data-aos-delay="300"><a href="{{ route('shop')}}" class="btn btn-outline-black">Shop Now</a></p>
                            @endif

                        </div>
                    </div>
                </div>
            </div> <!-- /.untree_co-hero -->
        </div>
        @endif
        @endforeach
    
</div>

<div class="untree_co-section">
    <div class="container">

        <div class="row">
            <div class="col-12 mb-2">
                <h2 class="h3 ">New Product</h2>        
            </div>

            @foreach ($product as $item)
                <div class="col-6 col-sm-6 col-md-6 mb-4 col-lg-4 ">
                    <div class="product-item">
                        <div class="label new top-right">
                            <div class='content'>New</div>
                        </div>
                        <a href="{{ route('detail-shop', $item->id)}}" class="product-img">                      
                            <img src="{{ asset('storage/images_product/'. $item->image)}}" alt="Image" class="img-fluid">
                        </a>
                        <h3 class="title"><a href="#">{{ $item->name}}</a></h3>
                        <div class="price">
                            <span>@currency($item->price)</span>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div> 

<div class="untree_co-section">
    <div class="container">
        <div class="row mb-3 align-items-center">
            <div class="col-md-6">
                <h2 class="h3">Discount Product</h2>        
            </div>
            <div class="col-sm-6 carousel-nav text-sm-right">
                <a href="#" class="prev js-custom-prev-v2">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-left-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path fill-rule="evenodd" d="M8.354 11.354a.5.5 0 0 0 0-.708L5.707 8l2.647-2.646a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708 0z"/>
                        <path fill-rule="evenodd" d="M11.5 8a.5.5 0 0 0-.5-.5H6a.5.5 0 0 0 0 1h5a.5.5 0 0 0 .5-.5z"/>
                    </svg>
                </a>
                <a href="#" class="next js-custom-next-v2">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-right-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path fill-rule="evenodd" d="M7.646 11.354a.5.5 0 0 1 0-.708L10.293 8 7.646 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0z"/>
                        <path fill-rule="evenodd" d="M4.5 8a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5z"/>
                    </svg>
                </a>
            </div>
        </div> <!-- /.heading -->

        <div class="owl-3-slider owl-carousel">
            @foreach ($product_discount  as $item)
                <div class="item">
                    <div class="product-item">
                        <a href="{{ route('detail-shop', $item->id)}}" class="product-img">
                            <img src="{{ asset('storage/images_product/'. $item->image)}}" alt="Image" class="img-fluid">
                        </a>
                        <h3 class="title"><a href="#">{{ $item->name}}</a></h3>
                        <div class="price">
                            <del>@currency($item->price)</del> &mdash; <span>@currency($item->price_final)</span>
                        </div>
                    </div>
                </div> <!-- /.item -->
            @endforeach
        </div>
    </div> <!-- /.container -->
</div> 


    
@endsection