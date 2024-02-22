@extends('landing.layout.index')

@section('content')

    
<div class="page-heading bg-light">
    <div class="container">
        <div class="row align-items-end text-center">
            <div class="col-lg-7 mx-auto">
                <h1>Shop</h1>
                <p class="mb-4"><a href="{{ route('home')}}">Home</a> / <strong>Shop</strong></p>
            </div>
        </div>
    </div>
</div>

<div class="untree_co-section pt-3">
    <div class="container">
        <div class="row align-items-center mb-5">
            <div class="col-lg-8">
            <h2 class="mb-3 mb-lg-0">Products</h2>
            </div>
            <div class="col-lg-4">
                <div class="d-flex sort align-items-center justify-content-lg-end">
                    <strong class="mr-3">Sort by:</strong>
                    <form action="{{ route('shop_filter') }}" method="GET">
                        <select class="form-control" name="sort" onchange="this.form.submit()" required>
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Product</option>
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Ascending</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: descending</option>
                        </select>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">

        <div class="col-md-3">
          <ul class="list-unstyled categories">
            <li><strong>Categories</strong></li>
            @foreach ($category as $item)
            <li><a href="{{ route('shop_category', $item->id)}}">{{ $item->name}}  
                <span>{{ $item->products->count() }}</span> 
            </a></li>
            @endforeach
          </ul>
        </div>

        <div class="col-md-9">
            <div class="row">

                @forelse ($product as $item)
                    <div class="col-6 col-sm-6 col-md-6 mb-4 col-lg-4 ">
                        <div class="product-item">
                            <a href="{{ route('detail-shop', $item->id)}}" class="product-img">                      
                                <img src="{{ asset('storage/images_product/'. $item->image)}}" alt="Image" class="img-fluid">
                            </a>
                            <h3 class="title"><a href="#">{{ $item->name}}</a></h3>
                            <div class="price">
                                @if ($item->discount > 0)
                                <del>@currency($item->price)</del> / <span>@currency($item->price_final)</span>
                                @else
                                <span>@currency($item->price)</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                <div class="col-md-12 text-center">
                    <h4>Not Product.</h4>
                </div>
                @endforelse
                
            </div>

            <div class="row mt-5 pb-5">
                <div class="col-lg-12">
                    <div class="custom-pagination">
                        <ul class="list-unstyled">
                            @if ($product->onFirstPage())
                                <li class="disabled">
                                    <span>
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-left" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M5.854 4.646a.5.5 0 0 1 0 .708L3.207 8l2.647 2.646a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 0 1 .708 0z"/>
                                            <path fill-rule="evenodd" d="M2.5 8a.5.5 0 0 1 .5-.5h10.5a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                                        </svg>
                                    </span>
                                </li>
                            @else
                                <li>
                                    <a href="{{ $product->previousPageUrl() }}">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-left" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M5.854 4.646a.5.5 0 0 1 0 .708L3.207 8l2.647 2.646a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 0 1 .708 0z"/>
                                            <path fill-rule="evenodd" d="M2.5 8a.5.5 0 0 1 .5-.5h10.5a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                                        </svg>
                                    </a>
                                </li>
                            @endif
            
                            @foreach ($product->getUrlRange(1, $product->lastPage()) as $page => $url)
                                <li class="{{ $page == $product->currentPage() ? 'active' : '' }}">
                                    <a href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endforeach
            
                            @if ($product->hasMorePages())
                                <li>
                                    <a href="{{ $product->nextPageUrl() }}">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-right" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M10.146 4.646a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L12.793 8l-2.647-2.646a.5.5 0 0 1 0-.708z"/>
                                            <path fill-rule="evenodd" d="M2 8a.5.5 0 0 1 .5-.5H13a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 8z"/>
                                        </svg>
                                    </a>
                                </li>
                            @else
                                <li class="disabled">
                                    <span>
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-right" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M10.146 4.646a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L12.793 8l-2.647-2.646a.5.5 0 0 1 0-.708z"/>
                                            <path fill-rule="evenodd" d="M2 8a.5.5 0 0 1 .5-.5H13a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 8z"/>
                                        </svg>
                                    </span>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- /.untree_co-section -->




@endsection

