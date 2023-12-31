<nav class="navbar navbar-expand-lg nav-container border-0 ">
    <div class="container ">
      <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('/assets/images/BakeSpace.svg') }}" alt="" width="150px"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item ">
            <a class="nav-link {{Request::is('/') ?'active':''}} " aria-current="page" href="{{ url('/') }}">Home</a>
          </li>
          <li class="nav-item ">
            <a class="nav-link {{Request::is('category') ?'active':''}}" href="{{ url('/category') }}">Category</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{Request::is('cart') ?'active':''}}" href="{{ url('/cart') }}">
              Cart
              <span class="badge badge-pill bg-primary cart-count">0</span>
            </a>
          </li>
             @guest
              @if (Route::has('login'))
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                  </li>
              @endif

               @if (Route::has('register'))
                  <li class="nav-item">
                     <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                   </li>
               @endif
                        @else
                        <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                          </a>
                          <ul class="dropdown-menu" aria-labelledby="navbarDrowpdown">
                            <li>
                              <a class="dropdown-item" href="{{ url('dashboard')}}">
                                Dashboard
                              </a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="{{ url('my-orders')}}">
                                My Orders
                              </a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                              </a>
                              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                              </li>
                            </ul>
                        </li>
                            
                 @endguest
        </ul>
      </div>
    </div>
  </nav>