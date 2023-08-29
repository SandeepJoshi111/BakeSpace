@extends('layouts.front')

@section('title')
 Checkout
@endsection

@section('content')

<div class="py-3 shadow-sm route-container ">
    <div class="container">
        <h6 class="mb-0"><a href="{{ url('/') }}">Home</a>/
            <a href="{{ url('checkout')}}">Checkout</a>
        </h6>
    </div>
</div>
<div class="py-5 home-container">
    <div class="container mt-5 ">
        <form action="{{ url('place-order') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="subheading-font">Basic Details</h6>
                            <hr>
                            <div class="row checkout-form">
                                <div class="col-md-6">
                                    <label for="">First Name</label>
                                    <input type="text" class="form-control" value="{{Auth::user()->name}}" name="fname" placeholder="Enter First Name">
                                </div>
                                <div class="col-md-6">
                                    <label for="lastName">Last Name</label>
                                    <input type="text" class="form-control" value="{{Auth::user()->lname}}" name="lname"placeholder="Enter Last Name">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Email</label>
                                    <input type="text" class="form-control" value="{{Auth::user()->email}}" name="email" placeholder="Enter Email">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Phone Number</label>
                                    <input type="text" class="form-control" value="{{Auth::user()->phone}}" name="phone" placeholder="Enter Phone Number">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Address 1</label>
                                    <input type="text" class="form-control" value="{{Auth::user()->address1}}" name="address1" placeholder="Enter Address 1">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Address 2</label>
                                    <input type="text" class="form-control" value="{{Auth::user()->address2}}" name="address2" placeholder="Enter Address 2">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">City</label>
                                    <input type="text" class="form-control" value="{{Auth::user()->city}}" name="city" placeholder="Enter City">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">State</label>
                                    <input type="text" class="form-control" value="{{Auth::user()->state}}" name="state" placeholder="Enter State">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Country</label>
                                    <input type="text" class="form-control" value="{{Auth::user()->country}}" name="country" placeholder="Enter Country">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Pincode</label>
                                    <input type="text" class="form-control" value="{{Auth::user()->pincode}}" name="pincode" placeholder="Enter Pincode">
                                </div>
                                
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                        <h6 class="subheading-font">Order Details</h6>
                        <hr>
                        <table class="table table-stripped table-border">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($cartitems as $item)
                                <tr>
                                    <td>{{ $item->products->name }}</td>
                                    <td>{{$item->prod_qty}}</td>
                                    <td>Rs. {{ $item->products->selling_price }}</td>
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <hr>
                        <button type="submit" class="btn btn-primary float-end">Place Order</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection