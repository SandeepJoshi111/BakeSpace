@extends('layouts.front')

@section('title')
{{$products->name}}
@endsection

@section('content')
    <div class="py-3 mb-4 shadow-sm ">
        <div class="container">
            <h6 class="mb-0"><a href="{{ url('category') }}">Collection</a>/<a href="{{ url('view-category/'.$products->category->slug)}}">{{$products->category->name}}</a>/{{$products->name}}</h6>
        </div>
    </div>

    <div class="container">
        {{-- Here product_data is data of id and quantity together --}}
        <div class="card product_data"> 
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 border-right">
                        <img src="{{ asset('assets/uploads/products/'.$products->image) }}" alt="Image" class="w-100" style="height: 500px">
                    </div>
                    <div class="col-md-8">
                        <h2 class="mb-0">
                            {{$products->name}}
                            <label style="font-size: 16px;" class="float-end badge bg-danger trending-tag">{{$products->trending =='1'? 'Trending':''}}</label>
                        </h2>

                        <hr>

                        <label class="fw-bold">Price: Rs {{$products->selling_price}}</label>

                        <p class="mt-3">
                            {!!$products->small_description!!}
                        </p>

                        <hr>

                        @if($products->qty>0)
                            <label class="badge bg-success">In stock</label>
                        @else
                            <label class="badge bg-danger">Out of stock</label>
                        @endif

                        <div class="row mt-2">
                            <div class="col-md-2">
                                <input type="hidden" value="{{$products->id}}" class="prod_id">
                                <label for="Quantity">Quantity</label>
                                <div class="input-group text-center mb-3">
                                    <button class="input-group-text decrement-btn">-</button>
                                    <input type="text" name="quantity" value="1" class="form-control text-center qty-input" value="1"/>
                                    <button class="input-group-text increment-btn">+</button>
                                </div>
                            </div>
                            <div class="cold-md-10">
                                <br>
                            @if($products->qty>0)
                                <button type="button" class="btn btn-primary me-3 float-start addToCartBtn">Add to Cart</button>
                            @else
                            @endif
                                <button type="button" class="btn btn-success me-3 float-start ">Add to Wishlist</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <hr>
                    <h3>Description</h3>
                    <p class="mt-3">
                        {!!$products->description!!}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

