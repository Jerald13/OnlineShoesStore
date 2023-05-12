<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Online Shoes Store</title>
    <style>
        .icon-hover:hover {
            border-color: #3b71ca !important;
            background-color: white !important;
        }

        .icon-hover:hover i {
            color: #3b71ca !important;
        }
    </style>
</head>
<body>
<!--Main Navigation-->
<header>
    <!-- Jumbotron -->
    <div class="p-3 text-center bg-white border-bottom">
        <div class="container">
            <div class="row gy-3">
                <!-- Left elements -->
                <div class="col-lg-2 col-sm-4 col-4">
                    <a href="{{ route("index") }}" style="text-decoration:none;">
                        <h5>Online Shoes Store</h5>
                      </a>
                      
                </div>
                <!-- Left elements -->

                <!-- Center elements -->
                <div class="order-lg-last col-lg-5 col-sm-8 col-8">
                    <div class="d-flex float-end">
                        <a href="{{route('getFreeGift')}}"
                           class="me-1 border rounded py-1 px-3 nav-link d-flex align-items-center">
                            <p class="d-none d-md-block mb-0">Free Gift Redemption</p>
                        </a>
                        <a href="{{route('orders')}}" class="me-1 border rounded py-1 px-3 nav-link d-flex align-items-center">
                            <p class="d-none d-md-block mb-0">Orders</p>
                        </a>
                        <a href="{{route('logout')}}"
                           class="me-1 border rounded py-1 px-3 nav-link d-flex align-items-center">
                            <p class="d-none d-md-block mb-0">Logout</p>
                        </a>
                    </div>
                </div>
                <!-- Center elements -->

                <!-- Right elements -->
                <div class="col-lg-5 col-md-12 col-12"></div>
                <!-- Right elements -->
            </div>
        </div>
    </div>
    <div class="bg-primary text-white py-5">
        <div class="container py-5">
            <h1>
                Best products & <br/>
                brands in our store
            </h1>
            <p>
                Trendy Products, Factory Prices, Excellent Service
            </p>
        </div>
    </div>
    <!-- Jumbotron -->
</header>
<!-- Products -->
<section>
    <div class="container my-5">
        <header class="mb-4">
            <h3>New products</h3>
        </header>

        <div class="row">
            @foreach($products as $product)
                <div class="col-lg-3 col-md-6 col-sm-6 d-flex">
                    <div class="card w-100 my-2 shadow-2-strong">
                        <img src="{{$product->imageUrl}}"
                             class="card-img-top" style="aspect-ratio: 1 / 1"/>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{$product->name}}</h5>
                            <p class="card-text">RM {{$product->price}}</p>
                            <p class="card-text">Quantity : {{$product->quantity}}</p>
                            <div class="card-footer d-flex align-items-end pt-3 px-0 pb-0 mt-auto">
                                <a href="{{route('checkout', [$product->id])}}" class="btn btn-primary shadow-0 me-1">Buy</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
</section>
<!-- Products -->


<!-- Footer -->
<footer class="text-center text-lg-start text-muted mt-3" style="background-color: #f5f5f5;">
    <!-- Section: Links  -->
    <section class="">
        <div class="container text-center text-md-start pt-4 pb-4">
            <!-- Grid row -->
            <div class="row mt-3">
                <!-- Grid column -->
                <div class="col-12 col-lg-3 col-sm-12 mb-2">

                    <p class="mt-2 text-dark">
                        © 2023 Copyright: MDBootstrap.com
                    </p>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-6 col-sm-4 col-lg-2">
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-6 col-sm-4 col-lg-2">

                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-6 col-sm-4 col-lg-2">

                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-12 col-sm-12 col-lg-3">

                </div>
                <!-- Grid column -->
            </div>
            <!-- Grid row -->
        </div>
    </section>
</footer>
<!-- Footer -->
</body>
</html>
