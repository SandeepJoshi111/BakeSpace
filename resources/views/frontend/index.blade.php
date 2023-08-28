@extends('layouts.front')

@section('title')
    Welcome to BakeSpace
@endsection

@section('content')
    @include('layouts.inc.slider')
    
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <img src="" alt="Image">
                        <div class="card-body">
                            <h5>Demo Product</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection