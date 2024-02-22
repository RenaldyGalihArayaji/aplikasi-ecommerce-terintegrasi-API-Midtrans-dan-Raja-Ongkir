@extends('landing.layout.index')

@section('content')

<div class="page-heading bg-light">
    <div class="container">
        <div class="row align-items-end text-center">
            <div class="col-lg-7 mx-auto">
                <h1>My Orders</h1>  
                <p class="mb-4"><a href="{{ route('home')}}">Home</a> / <strong>My Orders</strong></p>        
            </div>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="row mb-5 justify-content-center">
        <div class="site-blocks-table ">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="product-price">ORDER ID</th>
                        <th class="product-total">GRAND TOTAL</th>
                        <th class="product-total">STATUS</th>
                        <th class="product-total">PAYMENT</th>
                        <th class="product-remove">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaksi as $item)
                        <tr>
                            <td>{{ $item->invoice }}</td>
                            <td>@currency($item->grand_total)</td>
                            <td>
                                @if($item->status_delivery == 'process')
                                    <span>Process</span>
                                @elseif($item->status_delivery == 'shipping')
                                    <span>Shipping</span>
                                @elseif($item->status_delivery == 'completed')
                                    <span>Completed</span>
                                @endif
                            </td>
                            <td>
                                @if($item->status_payment == 'unpaid')
                                    <span>Unpaid</span>
                                @elseif($item->status_payment == 'paid')
                                    <span>Paid</span>
                                @endif
                            </td>
                            <td>
                                @if ($item->status_payment == 'unpaid')
                                <a href="{{ route('payment', $item->id)}}" class="btn btn-black">Payment</a>
                                <form action="{{ route('info.destroy', $item->id)}}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-black btn-sm">X</button>
                                </form>
                                @else
                                    <a href="{{ route('info.show', $item->id)}}" class="btn btn-black">Details</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

