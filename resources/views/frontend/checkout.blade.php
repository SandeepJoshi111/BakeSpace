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
                                    <input type="text" class="form-control firstname" value="{{Auth::user()->name}}" name="fname" placeholder="Enter First Name">
                                    <span id="fname_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="lastName">Last Name</label>
                                    <input type="text" class="form-control lastname" value="{{Auth::user()->lname}}" name="lname"placeholder="Enter Last Name">
                                    <span id="lname_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Email</label>
                                    <input type="text" class="form-control email" value="{{Auth::user()->email}}" name="email" placeholder="Enter Email">
                                    <span id="email_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Phone Number</label>
                                    <input type="text" class="form-control phone" value="{{Auth::user()->phone}}" name="phone" placeholder="Enter Phone Number">
                                    <span id="phone_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Address 1</label>
                                    <input type="text" class="form-control address1 " value="{{Auth::user()->address1}}" name="address1" placeholder="Enter Address 1">
                                    <span id="address1_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Address 2</label>
                                    <input type="text" class="form-control address2" value="{{Auth::user()->address2}}" name="address2" placeholder="Enter Address 2">
                                    <span id="address2_error" class="text-danger"></span>

                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">City</label>
                                    <input type="text" class="form-control city" value="{{Auth::user()->city}}" name="city" placeholder="Enter City">
                                    <span id="city_error" class="text-danger"></span>

                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">State</label>
                                    <input type="text" class="form-control state" value="{{Auth::user()->state}}" name="state" placeholder="Enter State">
                                    <span id="state_error" class="text-danger"></span>

                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Country</label>
                                    <input type="text" class="form-control country" value="{{Auth::user()->country}}" name="country" placeholder="Enter Country">
                                    <span id="country_error" class="text-danger"></span>

                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Pincode</label>
                                    <input type="text" class="form-control pincode" value="{{Auth::user()->pincode}}" name="pincode" placeholder="Enter Pincode">
                                    <span id="pincode_error" class="text-danger"></span>

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
                        @if ($cartitems->count()>0)
                            
                 
                        <table class="table table-stripped table-border">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total=0;@endphp
                                @foreach ($cartitems as $item)
                                <tr>
                                    @php $total += ($item->products->selling_price*$item->prod_qty)  @endphp
                                    <td>{{ $item->products->name }}</td>
                                    <td>{{$item->prod_qty}}</td>
                                    <td>Rs. {{ $item->products->selling_price }}</td>
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <h6 class="px-2">Grand TOtal <span class="float-end">Rs. {{$total}}</span></h6>
                        <hr>
                    
                        <button type="submit" class="btn btn-success float-end w-100">Place Order | COD</button>
                        <button type="button" class="btn btn-primary w-100 mt-3 khalti-btn" id="payment-button" >Pay with Khalti</button>
                        @else
                            <h4 class="text-center">No products in cart</h4>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>
<script>
    var config = {
        // replace the publicKey with yours
        "publicKey": "test_public_key_6fb945ec06fc434daf6e3ef38d383c3e",
        "productIdentity": "1234567890",
        "productName": "Dragon",
        "productUrl": "http://gameofthrones.wikia.com/wiki/Dragons",
        "paymentPreference": [
            "KHALTI",
            "EBANKING",
            "MOBILE_BANKING",
            "CONNECT_IPS",
            "SCT",
            ],
        "eventHandler": {
            onSuccess (payload) {
                // hit merchant api for initiating verfication
                console.log(payload);
                swal("Payment Success", "success");
            },
            onError (error) {
                console.log(error);
            },
            onClose () {
                console.log('widget is closing');
            }
        }
    };

    var checkout = new KhaltiCheckout(config);
    var btn = document.getElementById("payment-button");
    btn.onclick = function () {
        // minimum transaction amount must be 10, i.e 1000 in paisa.
        checkout.show({amount: 1000});
    }
</script>
@endsection