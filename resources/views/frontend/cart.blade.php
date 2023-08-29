@extends('layouts.front')

@section('title')
 My Cart
@endsection


@section('content')
<div class="py-3 mb-4 shadow-sm ">
    <div class="container">
        <h6 class="mb-0"><a href="{{ url('/') }}">Home</a>/
            <a href="{{ url('cart')}}">Cart</a>
        </h6>
    </div>
</div>
<div class="container py-5">
    <div class="card shadow ">
        <div class="card-body">
            @php $total =0;  @endphp
            @foreach ($cartitems as $item)   
            <div class="row product_data">
                <div class="col-md-2 my-auto">
                    <img src="{{ asset('assets/uploads/products/'.$item->products->image) }}" height="70px" width="70px" alt="Image Here">
                </div>
                <div class="col-md-3 my-auto">
                    <h6>{{$item->products->name}}</h6>
                </div>
                <div class="col-md-2 my-auto">
                    <h6>Rs. {{$item->products->selling_price}}</h6>
                </div>
                <div class="col-md-3 my-auto">
                    <input type="hidden" value="{{$item->prod_id}}" class="prod_id">
                                <label for="Quantity">Quantity</label>
                                <div class="input-group text-center mb-3" style="width: 130px">
                                    <button class="input-group-text changeQuantity decrement-btn">-</button>
                                    <input type="text" name="quantity" class="form-control text-center qty-input" 
                                    value="{{$item->prod_qty}}"/>
                                    <button class="input-group-text changeQuantity increment-btn">+</button>
                                </div>
                </div>
                <div class="col-md-2 my-auto">
                    <button class="btn btn-danger delete-cart-item ">Remove</button>
                </div>
            </div>

            @php $total += $item->products->selling_price*$item->prod_qty ;  @endphp

            @endforeach

        </div>
        <div class="card-footer">
            <h6 class="float-start mt-2">Total Price : Rs. {{$total}}</h6>
            <button class="btn btn-outline-success float-end">Proceed to Checkout</button>
        </div>
    </div>
</div>

@endsection