@extends('layouts.front')

@section('title')
    Category
@endsection

@section('content')
    <div class="py-2 home-container">
        <div class="container container-home">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="heading-font">All categories</h2>
                    <div class="row">
                        @foreach ($category as $cate)
                        <div class="col-md-4 mb-2 ">
                            <a href="{{ url('view-category/'.$cate->slug) }}">
                                <div class="card" style="height: 525px">
                                        <img src="{{ asset('assets/uploads/category/'.$cate->image) }}" alt="Category Image" style="height: 325px">
                                        <div class="card-body">
                                            <h5 class="subheading-font">{{$cate->name}}</h5>
                                            <p class="para-font">
                                                {{$cate->description}}
                                            </p>
                                    </div>
                                </div>
                             </a>
                        </div>
                        @endforeach
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection