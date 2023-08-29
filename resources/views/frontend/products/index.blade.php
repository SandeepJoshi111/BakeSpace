@extends('layouts.front')

@section('title')
{{$category->name}}
@endsection

@section('content')

<div class="py-3 mb-4 shadow-sm">
    <div class="container">
        <h6 class="mb-0"><a href="{{ url('category') }}">Collection</a>/{{$category->name}}</h6>
    </div>
</div>

        <div class="py-5">
            <div class="container">
                <div class="row">
                    <h2>{{$category->name}}</h2>
                        @foreach ($products as $prod)
                            <div class="col-md-3 mb-3">
                                <a href="{{ url('category/'.$category->slug.'/'.$prod->slug) }}">
                                    <div class="card" >
                                            <img src="{{ asset('assets/uploads/products/'.$prod->image) }}" alt="Image" style="height: 300px">
                                            <div class="card-body">
                                                <h5>{{$prod->name}}</h5>
                                                <span class="float-start">Rs. {{$prod->selling_price}}</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                </div>
            </div>
        </div>
@endsection