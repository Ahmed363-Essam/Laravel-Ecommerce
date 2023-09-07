<x-front-layout :title="$cats->name">

    @section('css')
    @endsection

    <x-slot name="breadcrumb">

        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                            <h1 class="page-title">{{ $cats->name }}</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <ul class="breadcrumb-nav">
                            <li><a href="{{ url('/') }}"><i class="lni lni-home"></i> Home</a></li>
      
                            <li> <a href="{{ route('Product.CatProduct',$cats->id) }}"> {{ $cats->name }} </a>  </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </x-slot>





    <!-- Start Item Details -->
    <!-- Start Product Grids -->
    <section class="product-grids section">
        <div class="container">
            <div class="row">

                <div class="col-lg-12 col-12">
                    <div class="product-grids-head">
                        <div class="product-grid-topbar">
                            <div class="row align-items-center">
                                <div class="col-lg-7 col-md-8 col-12">
                                    <div class="product-sorting">
                                        <label for="sorting">Sort by:</label>
                                        <select class="form-control" id="sorting">
                                            <option>Popularity</option>
                                            <option>Low - High Price</option>
                                            <option>High - Low Price</option>
                                            <option>Average Rating</option>
                                            <option>A - Z Order</option>
                                            <option>Z - A Order</option>
                                        </select>
                                        <h3 class="total-show-product">Showing: <span>1 - 12 items</span></h3>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-4 col-12">
                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <button class="nav-link active" id="nav-grid-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-grid" type="button" role="tab"
                                                aria-controls="nav-grid" aria-selected="true"><i
                                                    class="lni lni-grid-alt"></i></button>
                                            <button class="nav-link" id="nav-list-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-list" type="button" role="tab"
                                                aria-controls="nav-list" aria-selected="false"><i
                                                    class="lni lni-list"></i></button>
                                        </div>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-grid" role="tabpanel"
                                aria-labelledby="nav-grid-tab">
                                <div class="row">
                                    @foreach ($productsCats as $productsCat)
                                    <div class="col-lg-3 col-md-6 col-12">
                                        <!-- Start Single Product -->
                                        <div class="single-product">
                                            <div class="product-image">
                                                <img src="{{ $productsCat->immage_url }}" style="width:335px; height:335px" alt="#">
                                                <div class="button">
                                                    <a href="product-details.html" class="btn"><i
                                                            class="lni lni-cart"></i> Add to Cart</a>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <span class="category">{{ $productsCat->cats1->name }}</span>
                                                <h4 class="title">
                                                    <a href="{{ route('product.show',$productsCat->id) }}">{{ $productsCat->name }}</a>
                                                </h4>

                                                <div class="price">
                                                    <span>${{ $productsCat->price }}</span>
                                                    <span class="discount-price"> ${{ $productsCat->sale_percent }} </span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Single Product -->
                                    </div>
                                    @endforeach
               


    
       
                                </div>

                            </div>
                            <div class="tab-pane fade" id="nav-list" role="tabpanel" aria-labelledby="nav-list-tab">
                                <div class="row">

                                    @foreach ( $productsCats as $productsCat )
                                    <div class="col-lg-12 col-md-12 col-12">
                                        <!-- Start Single Product -->
                                        <div class="single-product">
                                            <div class="row align-items-center">
                                                <div class="col-lg-4 col-md-4 col-12">
                                                    <div class="product-image">
                                                        <img src="{{ $productsCat->immage_url }}" alt="#">
                                                        <div class="button">
                                                            <a href="product-details.html" class="btn"><i
                                                                    class="lni lni-cart"></i> Add to
                                                                Cart</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-8 col-md-8 col-12">
                                                    <div class="product-info">
                                                        <span class="category">{{ $productsCat->cats1->name }}</span>
                                                        <h4 class="title">
                                                            <a href="product-grids.html">{{ $productsCat->name }}</a>
                                                        </h4>
                                 
                                                        <div class="price">
                                                            <span>${{ $productsCat->price }}</span>
                                                            <span class="discount-price"> ${{ $productsCat->sale_percent }} </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Single Product -->
                                    </div>
                                    @endforeach
                           


   
                                </div>
   
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Product Grids -->
 


    @section('scripts')
        <script type="text/javascript">
            const current = document.getElementById("current");
            const opacity = 0.6;
            const imgs = document.querySelectorAll(".img");
            imgs.forEach(img => {
                img.addEventListener("click", (e) => {
                    //reset opacity
                    imgs.forEach(img => {
                        img.style.opacity = 1;
                    });
                    current.src = e.target.src;
                    //adding class 
                    //current.classList.add("fade-in");
                    //opacity
                    e.target.style.opacity = opacity;
                });
            });
        </script>
    @endsection

</x-front-layout>
