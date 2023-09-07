<x-front-layout title='ahmed'>

    <x-slot name="breadcrumb">

        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                            <h1 class="page-title">Categories</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <ul class="breadcrumb-nav">
                            <li><a href="{{ url('/') }}"><i class="lni lni-home"></i> Home</a></li>
                            <li><a href="index.html">Categories</a></li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </x-slot>


    <!-- Shopping Cart -->
    <div class="shopping-cart section">
        <div class="container">

            <!-- Start Featured Categories Area -->
            <section class="featured-categories section">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="section-title">
                                <h2>Featured Categories</h2>
                                <p>There are many variations of passages of Lorem Ipsum available, but the majority have
                                    suffered alteration in some form.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        @foreach ($cats as $cat)
                            <div class="col-lg-4 col-md-6 col-12">
                                <!-- Start Single Category -->
                                <div class="single-category" style="height: 220px;">
                                    <h3 class="heading"> {{ $cat->name }} </h3>
                                    <ul>
                                        @foreach ($cat->products1 as $product_cat)
                                            <li><a
                                                    href="{{ route('product.show', $product_cat->id) }}">{{ $product_cat->name }}</a>
                                            </li>
                                        @endforeach

                                        <li><a href="{{ route('product.index') }}">View All</a></li>
                                    </ul>
                                    <div class="images">
                                        <img src="{{ $cat->getImmageUrlAttribute() }}"
                                            style="height: 180px; width: 180px;" alt="#">
                                    </div>
                                </div>
                                <!-- End Single Category -->
                            </div>
                        @endforeach


                    </div>
                </div>
            </section>

        </div>
    </div>


</x-front-layout>
