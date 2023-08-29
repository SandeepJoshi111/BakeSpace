@extends('layouts.front')

@section('title')
    Welcome to BakeSpace
@endsection

@section('content')
    @include('layouts.inc.slider')
    
    <div class="py-5">
        <div class="container">
            <div class="row">
                <h2>Our Best Seller</h2>
                <div class="owl-carousel featured-carousel owl-theme">
               
                    @foreach ($featured_products as $prod)
                        <div class="item">
                            <div class="card" >
                                    <img src="{{ asset('assets/uploads/products/'.$prod->image) }}" alt="Image" style="height: 300px">
                                    <div class="card-body">
                                        <h5>{{$prod->name}}</h5>
                                        <span class="float-start">Rs. {{$prod->selling_price}}</span>
                                </div>
                            </div>
                        </div>
                     @endforeach
                </div>
            </div>
        </div>
    </div>


    <div class="py-5">
        <div class="container">
            <div class="row">
                <h2>Trending Category</h2>
                <div class="owl-carousel trending-carousel owl-theme">
               
                    @foreach ($trending_category as $tcategory)
                        <div class="item">
                            <div class="card" >
                                    <img src="{{ asset('assets/uploads/category/'.$tcategory->image) }}" alt="Image" style="height: 400px">
                                    <div class="card-body">
                                        <h5>{{$tcategory->name}}</h5>
                                        
                                </div>
                            </div>
                        </div>
                     @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
<script>
    $('.featured-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    dots:false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:4
        }
    }
})

$('.trending-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    dots:false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:3
        }
    }
})
</script>
    
@endsection