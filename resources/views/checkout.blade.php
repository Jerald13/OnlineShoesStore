<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Online Shoes Store</title>
</head>
<body>
<header>
    <!-- Jumbotron -->
    <div class="p-3 text-center bg-white border-bottom">
        <div class="container">
            <div class="d-flex justify-content-between">
                <!-- Left elements -->
                <div class="col-lg-2 col-sm-4 col-4">
                    <h5>Online Shoes Store</h5>
                </div>
                <!-- Left elements -->

                <!-- Center elements -->
                <div class="order-lg-last col-lg-5 col-sm-8 col-8">
                    <div class="d-flex float-end">
                        <a href="{{route('getFreeGift')}}"
                           class="me-1 border rounded py-1 px-3 nav-link d-flex align-items-center">
                            <p class="d-none d-md-block mb-0">Free Gift Redemption</p>
                        </a>
                        <a href="{{route('orders')}}"
                           class="me-1 border rounded py-1 px-3 nav-link d-flex align-items-center">
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
    <!-- Jumbotron -->

    <!-- Heading -->
    <div class="bg-primary">
        <div class="container py-4">
            <!-- Breadcrumb -->
            <nav class="d-flex">
                <h6 class="mb-0">
                    <a href="{{route('index')}}" class="text-white-50">Home</a>
                </h6>
            </nav>
            <!-- Breadcrumb -->
        </div>
    </div>
    <!-- Heading -->
</header>

<section class="bg-light py-5">
    <div class="container">
        <div class="row">
            @if($error)
                <div class="card mb-4 border shadow-0">
                    <div class="p-4 d-flex justify-content-between">
                        <div class="">
                            <h5>Errors</h5>
                            <p class="mb-0 text-wrap ">{{$error}}</p>
                        </div>
                    </div>
                </div>
            @else
                <div class="col-xl-8 col-lg-8 mb-4">
                    <form action="{{route('buyProduct')}}" method="post">
                        <!-- Checkout -->
                        <div class="card shadow-0 border">
                            <div class="p-4">
                                <h5 class="card-title mb-3">Checkout</h5>
                                <div class="row mb-3">
                                    <div class="col-lg-4 mb-3">
                                        <!-- Default checked radio -->
                                        <div class="form-check h-100 border rounded-3">
                                            <div class="p-3">
                                                <input class="form-check-input" type="radio" name="deliveryMethod"
                                                       id="flexRadioDefault1" checked/>
                                                <label class="form-check-label" for="deliveryMethod">
                                                    Express delivery <br/>
                                                    <small class="text-muted">3-4 days via Fedex </small>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mb-3"></div>
                                    <div class="col-lg-4 mb-3"></div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12 mb-3">
                                        <p class="mb-0">Address</p>
                                        <div class="form-outline">
                                            <input type="text" id="typeText" name="address" placeholder="Type here"
                                                   class="form-control"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    @foreach($banks as $bank)
                                        <div class="col-lg-4 mb-3">
                                            <!-- Default checked radio -->
                                            <div class="form-check h-100 border rounded-3">
                                                <div class="p-3">
                                                    <input class="form-check-input" type="radio" name="paymentMethod"
                                                           id="paymentMethod"/>
                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                        {{$bank["name"]}}<br/>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="float-end">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$product->id}}"/>
                                    <button type="submit" class="btn btn-success shadow-0 border">Checkout</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- Checkout -->
                </div>
                <div class="col-xl-4 col-lg-4 d-flex justify-content-center justify-content-lg-end">
                    <div class="ms-lg-4 mt-4 mt-lg-0" style="max-width: 320px;">
                        <h6 class="mb-3">Summary</h6>
                        <div class="d-flex justify-content-between">
                            <p class="mb-2">Total price:</p>
                            <p class="mb-2 fw-bold">RM {{$product->price}}</p>
                        </div>

                        <hr/>
                        <h6 class="text-dark my-4">Items to Purchase</h6>

                        <div class="d-flex align-items-center mb-4">
                            <div class="me-3 position-relative">
                              <span
                                  class="position-absolute top-0 start-100 translate-middle badge rounded-pill badge-secondary">
                                1
                              </span>
                                <img src="{{$product->imageUrl}}"
                                     style="height: 96px; width: 96px;" class="img-sm rounded border"/>
                            </div>
                            <div class="">
                                <a href="#" class="nav-link"> {{$product->name}}
                                </a>
                                <div class="price text-muted">Total: RM {{$product->price}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="text-center text-lg-start text-muted bg-primary mt-3">
    <!-- Section: Links  -->
    <section class="">
        <div class="container text-center text-md-start pt-4 pb-4">
            <!-- Grid row -->
            <div class="row mt-3">
                <!-- Grid column -->
                <div class="col-12 col-lg-3 col-sm-12 mb-2">
                    <p class="mt-1 text-white">
                        Online Shoes Store © 2023 Copyright: MDBootstrap.com
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
    <!-- Section: Links  -->
</footer>
<!-- Footer -->
</body>
</html>
