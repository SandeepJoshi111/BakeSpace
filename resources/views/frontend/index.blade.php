@extends('layouts.front')

@section('title')
    Welcome to BakeSpace
@endsection

@section('content')
    @include('layouts.inc.slider')
    
    <div class="py-5 home-container">
        <div class="container container-home">
            <div class="row mt-5">
                <h2 class="heading-font">Our Best Seller</h2>
                <div class="owl-carousel featured-carousel owl-theme">
               
                    @foreach ($featured_products as $prod)
                        <div class="item">
                            <div class="card" >
                                    <img src="{{ asset('assets/uploads/products/'.$prod->image) }}" alt="Image" style="height: 300px">
                                    <div class="card-body">
                                        <h5 class="subheading-font">{{$prod->name}}</h5>
                                        <p class="para-font">Rs. {{$prod->selling_price}}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <img src="{{ asset('/assets/images/wavesvg1.svg')}}" alt="" class="wave1">
    </div>


    <div class="py-5 trending-container">
        <img src="{{ asset('/assets/images/wave2.svg')}}" alt="" class="wave2">
        <div class="container container-home">
            <div class="row mt-5">
                <h2 class="heading-font">Trending Category</h2>
                <div class="owl-carousel trending-carousel owl-theme">
               
                    @foreach ($trending_category as $tcategory)
                        <div class="item">
                            <a href="{{ url('view-category/'.$tcategory->slug) }}">
                                <div class="card" >
                                        <img src="{{ asset('assets/uploads/category/'.$tcategory->image) }}" alt="Image" style="height: 400px">
                                        <div class="card-body">
                                            <h5 class="subheading-font">{{$tcategory->name}}</h5>
                                            
                                    </div>
                                </div>
                             </a>
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