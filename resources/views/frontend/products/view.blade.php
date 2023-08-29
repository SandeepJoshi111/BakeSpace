@extends('layouts.front')

@section('title')
{{$products->name}}
@endsection

@section('content')
    <div class="py-3 shadow-sm route-container">
        <div class="container">
            <h6 class="mb-0"><a href="{{ url('category') }}">Collection</a>/<a href="{{ url('view-category/'.$products->category->slug)}}">{{$products->category->name}}</a>/{{$products->name}}</h6>
        </div>
    </div>

    <div class="py-2 home-container-slug">
    <div class="container">
        {{-- Here product_data is data of id and quantity together --}}
        <div class="card product_data"> 
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 border-right">
                        <img src="{{ asset('assets/uploads/products/'.$products->image) }}" alt="Image" class="w-100" style="width: 100px; height: 400px">
                    </div>
                    <div class="col-md-8">
                        <h2 class="mt-2  heading-font">
                            {{$products->name}}
                            <label style="font-size: 25px;" class="float-end badge bg-danger trending-tag ">{{$products->trending =='1'? 'Trending':''}}</label>
                        </h2>

                        <hr>

                        <label class="fw-bold para-font">Price: Rs {{$products->selling_price}}</label>

                        <p class="mt-1 para-font">
                            {!!$products->small_description!!}
                        </p>

                        <hr>

                        @if($products->qty>0)
                            <label class="badge bg-success" style="font-size: 16px">In stock</label>
                        @else
                            <label class="badge bg-danger" style="font-size: 16px">Out of stock</label>
                        @endif

                        <div class="row mt-1">
                            <div class="col-md-2">
                                <input type="hidden" value="{{$products->id}}" class="prod_id">
                                <label for="Quantity" class="para-font">Quantity</label>
                                <div class="input-group text-center mb-1 ">
                                    <button class="input-group-text decrement-btn">-</button>
                                    <input type="text" name="quantity" value="1" class="form-control text-center qty-input " value="1"/>
                                    <button class="input-group-text increment-btn">+</button>
                                </div>
                            </div>
                            <div class="md-10">
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
                    <h3 class="subheading-font">Description</h3>
                    <p class="mt-1 para-font">
                        {!!$products->description!!}
                    </p>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

