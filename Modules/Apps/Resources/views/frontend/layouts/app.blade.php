@extends('front.layouts.main')

@section('content')

    <main>

        <div class="position-relative">
            <!-- Hero for FREE version -->
            <section class="section section-lg section-hero section-shaped">
                <!-- Background circles -->
                <div class="shape shape-style-1 shape-primary">
                    <span class="span-150"></span>
                    <span class="span-50"></span>
                    <span class="span-50"></span>
                    <span class="span-75"></span>
                    <span class="span-100"></span>
                    <span class="span-75"></span>
                    <span class="span-50"></span>
                    <span class="span-100"></span>
                    <span class="span-50"></span>
                    <span class="span-100"></span>
                </div>
                <div class="container shape-container d-flex align-items-center py-lg">
                    <div class="col px-0">
                        <div class="row align-items-center justify-content-center">
                            <div class="col-lg-6 text-center">
                                <img alt="image" src="{{asset('front-2/img/poly-img/2-02.svg')}}" style="width: 500px;" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <!-- SVG separator -->
        <div class="separator separator-bottom separator-skew zindex-100">
            <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1"
                 xmlns="http://www.w3.org/2000/svg">
                <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div>
        </section>
        </div>
        <section class="section section-components pb-0" id="section-components">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <h1 class="mb-5 mt-5">What We Offer</h1>
                        </div>
                        <div class="row row-grid">
                            <div class="col-lg-4">
                                <div class="card card-lift--hover shadow border-0">
                                    <div class="card-body py-5">
                                        <div class="icon icon-shape icon-shape-primary rounded-circle mb-4">
                                            <i class="fas fa-dollar-sign"></i>
                                        </div>
                                        <h6 class="text-primary text-uppercase">Points</h6>
                                        <p class="description mt-3">you can get points from your purchases from any stores and restaurants
                                            to used it again for buying anything from the app places.</p>
                                        <div>
                                            <span class="badge badge-pill badge-primary">profit</span>
                                            <span class="badge badge-pill badge-primary">system</span>
                                            <span class="badge badge-pill badge-primary">creative</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card card-lift--hover shadow border-0">
                                    <div class="card-body py-5">
                                        <div class="icon icon-shape icon-shape-success rounded-circle mb-4">
                                            <i class="fas fa-user-cog"></i>
                                        </div>
                                        <h6 class="text-success text-uppercase">Customize</h6>
                                        <p class="description mt-3">if you are a store owner now you can get more customers and leads to
                                            your store from PolyPoint and get reports about your orders. </p>
                                        <div>
                                            <span class="badge badge-pill badge-success">business</span>
                                            <span class="badge badge-pill badge-success">vision</span>
                                            <span class="badge badge-pill badge-success">success</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card card-lift--hover shadow border-0">
                                    <div class="card-body py-5">
                                        <div class="icon icon-shape icon-shape-warning rounded-circle mb-4">
                                            <i class="fas fa-user-lock"></i>
                                        </div>
                                        <h6 class="text-warning text-uppercase">Secure</h6>
                                        <p class="description mt-3">don't worry about your data and reports, we used a multi security
                                            process to keep your data save. we always supports you to get what you want </p>
                                        <div>
                                            <span class="badge badge-pill badge-warning">secure</span>
                                            <span class="badge badge-pill badge-warning">product</span>
                                            <span class="badge badge-pill badge-warning">data</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="more" class="section pb-0 section-components">
            <div class="py-5  mt-5 bg-secondary">
                <div class="container">
                    <div class="row row-grid  align-items-center">
                        <div class="col-md-6 order-md-2">
                            <div>
                                <img src="{{asset('front-2/img/poly-img/graphic.png')}}" class="img-fluid floating ml-5" alt="image"
                                     style="width: 13rem;">
                            </div>
                            <div>
                                <img src="{{asset('front-2/img/theme/promo-1.png')}}" class="img-fluid floating" alt="image" style="width: 20rem;">
                            </div>
                        </div>
                        <div class="col-md-6 order-md-1">
                            <div class="pr-md-5">
                                <div class="icon icon-lg icon-shape icon-shape-success shadow rounded-circle mb-5">
                                    <i class="ni ni-settings-gear-65"></i>
                                </div>
                                <h3>Awesome features</h3>
                                <p><strong>Promote your products to grow faster</strong>. Create, manage, and track advertisements, all
                                    from your dashboard. Create low-cost advertisements that drive the right shoppers to your store
                                    in minutes. No experience required. You provide the dream, we’ll handle the techy stuff.
                                </p>
                                <p><strong>Your free online store is just a few clicks away</strong>. Set up your store once to easily
                                    sync and sell across a website, social media, marketplaces like Amazon, and live in-person. Get
                                    started with one, or try them all</p>
                                <ul class="list-unstyled mt-5">
                                    <li class="py-2">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <div class="badge badge-circle badge-success mr-3">
                                                    <i class="ni ni-settings-gear-65"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <h6 class="mb-0">Carefully crafted Dashboard</h6>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="py-2">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <div class="badge badge-circle badge-success mr-3">
                                                    <i class="ni ni-html5"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <h6 class="mb-0">Amazing System</h6>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="py-2">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <div class="badge badge-circle badge-success mr-3">
                                                    <i class="ni ni-satisfied"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <h6 class="mb-0">Super friendly support team</h6>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section section-shaped">
            <div class="shape shape-style-1 shape-default">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="container py-md">
                <div class="row justify-content-between align-items-center">
                    <div class="col-lg-5 mb-5 mb-lg-0">
                        <h1 class="text-white font-weight-light">Discover our App</h1>
                        <div class="d-flex align-items-center mt-5 ">
                            <div>
                                <div class="badge badge-circle badge-primary mr-3">
                                    <i class="ni ni-settings-gear-65"></i>
                                </div>
                            </div>
                            <div>
                                <h6 class="mb-0 text-white">EASY SETUP</h6>
                            </div>
                        </div>
                        <p class="text-white mt-1 ml-5">Sign up with simple data like your name, email and mobile number to start
                            collecting points and make orders from our app.</p>
                        <div class="d-flex align-items-center mt-5 ">
                            <div>
                                <div class="badge badge-circle badge-primary mr-3">
                                    <i class="fas fa-comments-dollar"></i>
                                </div>
                            </div>
                            <div>
                                <h6 class="mb-0 text-white">FLEXIBLE EARNING</h6>
                            </div>
                        </div>
                        <p class="text-white mt-1 ml-5">Let members earn points when they buy products, share purchases to Facebook
                            or Twitter, follow you on Instagram, refer new customers, or even just for signing up. </p>
                    </div>
                    <div class="col-lg-6 mb-lg-auto">
                        <div class="rounded shadow-lg overflow-hidden transform-perspective-right text-center">
                            <div id="carousel_example" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#carousel_example" data-slide-to="0" class="active"></li>
                                    <li data-target="#carousel_example" data-slide-to="1"></li>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img class="img-fluid" src="{{asset('front-2/img/poly-img/screen1.jpg')}}" alt="First slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="img-fluid" src="{{asset('front-2/img/poly-img/screen2.jpg')}}" alt="First slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="img-fluid" src="{{asset('front-2/img/poly-img/screen3.jpg')}}" alt="First slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="img-fluid" src="{{asset('front-2/img/poly-img/screen4.jpg')}}" alt="First slide">
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#carousel_example" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carousel_example" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- SVG separator -->
            <div class="separator separator-bottom separator-skew">
                <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1"
                     xmlns="http://www.w3.org/2000/svg">
                    <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
                </svg>
            </div>
        </section>
        <section class="section section-lg section-nucleo-icons pb-250">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2 class="display-3">Who Are We ?</h2>
                        <p class="lead">
                            <strong>Poly-Point</strong> is a project madded and manged by Xcrisis
                        </p>
                    </div>
                </div>
                <div class="blur--hover">
                    <a href="http://x-crisis.com/" target="blank">
                        <div class="icons-container blur-item mt-5" data-toggle="on-screen">
                            <!-- Center -->
                            <i class="icon ni">
                                <img src="{{asset('front-2/img/poly-img/logo.png')}}" style="width: 5rem;" alt="">
                            </i>
                            <!-- Right 1 -->
                            <i class="icon icon-sm ni ni-album-2"></i>
                            <i class="icon icon-sm ni ni-app"></i>
                            <i class="icon icon-sm ni ni-atom"></i>
                            <!-- Right 2 -->
                            <i class="icon ni ni-bag-17"></i>
                            <i class="icon ni ni-bell-55"></i>
                            <i class="icon ni ni-credit-card"></i>
                            <!-- Left 1 -->
                            <i class="icon icon-sm ni ni-briefcase-24"></i>
                            <i class="icon icon-sm ni ni-building"></i>
                            <i class="icon icon-sm ni ni-button-play"></i>
                            <!-- Left 2 -->
                            <i class="icon ni ni-calendar-grid-58"></i>
                            <i class="icon ni ni-camera-compact"></i>
                            <i class="icon ni ni-chart-bar-32"></i>
                        </div>
                        <span class="blur-hidden h5 text-success">Be a Part of Xcrisis</span>
                    </a>
                </div>
            </div>
        </section>
        <section class="section section-lg section-shaped">
            <div class="shape shape-style-1 shape-default">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="container py-md">
                <div class="row row-grid justify-content-between align-items-center">
                    <div class="col-lg-6">
                        <h3 class="display-3 text-white">Know More About Our System<span class="text-white">Communicate with
                PolyPoint
              </span></h3>
                        <p class="lead text-white">it's an easy system you will never get lost, you can register and enjoy with our
                            awesome features and authorities</p>
                    </div>
                    <div class="col-lg-5 mb-lg-auto">
                        <div class="transform-perspective-right">
                            <div class="card bg-secondary shadow border-0">
                                <div class="card-header bg-white pb-5">
                                    <div class="text-muted text-center mb-3">All you want to know about admin system</div>
                                    <div class="btn-wrapper text-center mt-4">
                                        <i class="fas fa-user-tie fa-5x"></i>
                                    </div>
                                </div>
                                <div class="card-body px-lg-5 py-lg-5">
                                    <div class="text-center">
                                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Doloremque architecto vel quisquam
                                            harum nisi tempora praesentium quia iste dolor labore.</p>
                                        <a href="{{url('about-app')}}" class="">Learn more &RightArrow;</a>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- SVG separator -->
            <div class="separator separator-bottom separator-skew">
                <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1"
                     xmlns="http://www.w3.org/2000/svg">
                    <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
                </svg>
            </div>
        </section>
        <section class="section section-lg">
            <div class="container">
                <div class="row row-grid justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2 class="display-3">Frequently Asked Questions? <span class="text-success">We Always Supports You<i
                                        class="fas fa-heart"></i></span>
                        </h2>
                        <div class="text-center">
                            <div class="row justify-content-center">
                                <div class="col-lg-12">
                                    <div id="accordion">
                                        <div class="card">
                                            <div class="card-header" id="headingOne">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"
                                                            aria-expanded="true" aria-controls="collapseOne">
                                                        Can I try before I buy?
                                                    </button>
                                                </h5>
                                            </div>

                                            <div id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                                                <div class="card-body">
                                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
                                                    Yes. We offer a 14-day free trial for Bold Loyalty Points, and you can uninstall anytime
                                                    during the trial at no charge.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" id="headingTwo">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo"
                                                            aria-expanded="false" aria-controls="collapseTwo">
                                                        How can customers redeem points?
                                                    </button>
                                                </h5>
                                            </div>
                                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                                <div class="card-body">
                                                    Once your customers have accrued enough points, they can redeem them for products through the
                                                    storefront widget like a percentage discount, or free shipping.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" id="headingThree">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree"
                                                            aria-expanded="false" aria-controls="collapseThree">
                                                        What are the setup fees?
                                                    </button>
                                                </h5>
                                            </div>
                                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                                <div class="card-body">
                                                    Our Merchant Success team is available to answer any questions you might have, or to walk you
                                                    through the steps needed to get the app up and running on your store.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>


@endsection

{{--UPLOAD--}}





