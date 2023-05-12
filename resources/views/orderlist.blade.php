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
        .card-stepper {
            z-index: 0
        }

        #progressbar-2 {
            color: #455A64;
        }

        #progressbar-2 li {
            list-style-type: none;
            font-size: 13px;
            width: 33.33%;
            float: left;
            position: relative;
        }

        #progressbar-2 #step1:before {
            content: '\f058';
            font-family: "Font Awesome 5 Free";
            color: #fff;
            width: 37px;
            margin-left: 0px;
            padding-left: 0px;
        }

        #progressbar-2 #step2:before {
            content: '\f058';
            font-family: "Font Awesome 5 Free";
            color: #fff;
            width: 37px;
        }

        #progressbar-2 #step3:before {
            content: '\f058';
            font-family: "Font Awesome 5 Free";
            color: #fff;
            width: 37px;
            margin-right: 0;
            text-align: center;
        }

        #progressbar-2 #step4:before {
            content: '\f111';
            font-family: "Font Awesome 5 Free";
            color: #fff;
            width: 37px;
            margin-right: 0;
            text-align: center;
        }

        #progressbar-2 li:before {
            line-height: 37px;
            display: block;
            font-size: 12px;
            background: #c5cae9;
            border-radius: 50%;
        }

        #progressbar-2 li:after {
            content: '';
            width: 100%;
            height: 10px;
            background: #c5cae9;
            position: absolute;
            left: 0%;
            right: 0%;
            top: 15px;
            z-index: -1;
        }

        #progressbar-2 li:nth-child(1):after {
            left: 1%;
            width: 100%
        }

        #progressbar-2 li:nth-child(2):after {
            left: 1%;
            width: 100%;
        }

        #progressbar-2 li:nth-child(3).active:after {
            left: 1%;
            width: 100%;
        }

        #progressbar-2 li:nth-child(4) {
            left: 0;
            width: 37px;
        }

        #progressbar-2 li:nth-child(4):after {
            left: 0;
            width: 0;
        }

        #progressbar-2 li.active:before,
        #progressbar-2 li.active:after {
            background: #6520ff;
        }
    </style>
</head>
<body>

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
    <!-- Jumbotron -->
</header>
<!-- Products -->
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
<section>
    <div class="container my-5">
        <header class="mb-4">
            <h3>Orders</h3>
        </header>

        <div class="row">
            @foreach($orders as $order)
                <section class="" style="background-color: #8c9eff;">
                    <div class="container py-5 h-100">
                        <div class="row d-flex justify-content-center align-items-center h-100">
                            <div class="col-12">
                                <div class="card card-stepper text-black" style="border-radius: 16px;">
                                    <div class="card-body p-5">
                                        <div class="d-flex justify-content-between align-items-center mb-5">
                                            <div>
                                                <h5 class="mb-0">INVOICE <span class="text-primary font-weight-bold">{{$order->id}}</span></h5>
                                            </div>
                                            <div class="text-end">
                                                <p class="mb-0">Product <span>{{$order->product->name}}</span></p>
                                                <p class="mb-0">Total Price : RM <span class="font-weight-bold">{{$order->product->price}}</span></p>
                                            </div>
                                        </div>

                                        <ul id="progressbar-2" class="d-flex justify-content-between mx-0 mt-0 mb-5 px-0 pt-0 pb-2">
                                            <li class="step0 active text-center" id="step1"></li>
                                            <li class="step0 active text-center" id="step2"></li>
                                            <li class="step0 active text-center" id="step3"></li>
                                            <li class="step0 {{$order->complete ? "active text-center text-muted text-end" : ""}}" id="step4"></li>
                                        </ul>

                                        <div class="d-flex justify-content-between">
                                            <div class="d-lg-flex align-items-center">
                                                <i class="fas fa-clipboard-list fa-3x me-lg-4 mb-3 mb-lg-0"></i>
                                                <div>
                                                    <p class="fw-bold mb-1">Order</p>
                                                    <p class="fw-bold mb-0">Processed</p>
                                                </div>
                                            </div>
                                            <div class="d-lg-flex align-items-center">
                                                <i class="fas fa-home fa-3x me-lg-4 mb-3 mb-lg-0"></i>
                                                <div>
                                                    <p class="fw-bold mb-1">Order</p>
                                                    <p class="fw-bold mb-0">Completed</p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>
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
</body>
</html>
