<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        
      <h3> <a href="{{url('/checkout')}}">Go To Checkout Page</a> </h3>
      
      <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
          @if(Session::has('alert-' . $msg))
          <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
          @endif
        @endforeach
      </div> 
      <hr>
        <form action="{{url('search')}}" method="get">
            @csrf
          <label for="gsearch">Search Product:</label>
          <input type="search" id="gsearch" name="search">
          <input type="submit">
        </form>
        <div class="flex-center">

            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">{{Auth::user()->name}}</a>
                       <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
            @foreach($products as $product)
            <div class="col-lg-6">
                <div>
                    <h2>@if(!empty($product->peoduct_name)){{$product->peoduct_name}} @endif</h2>
                    <h2> 
                        <span class="main-price">Rs. @if(!empty($product->price)) {{$product->price}} @endif</span>
                    </h2>
                    <form id="cart-form" action="{{url('add-to-cart')}}" method="get">
                    <div>
                        <div class="">
                            <input type="number" value="1" name="quantity" min="1">
                            <input type="hidden" value="{{$product->price}}" name="price">
                            <input type="hidden" value="{{$product->id}}" name="priduct_id">
                        </div>
                        <div class="add-to-cart-btn">
                           <button type="submit" class="btn btn-link">Add to Cart</button>
                        </div>
                    </div>
                    </form>
                    <div>
                        <h3>Categories: @if(!empty($product->category->category_name)){{$product->category->category_name}} @endif<span></span></h3>
                    </div> 
                </div>                        
            </div>
            @endforeach
        </div>
    </body>
</html>
