<div class="row cat-banner-row electronics">
    <div class="col-xl-3 col-xxl-4">
        <div class="cat-banner row no-gutters">
            <div class="cat-banner-list col-sm-6 d-xl-none d-xxl-flex" style="background-image: url({{ asset('themes/molla/assets/images/demos/demo-14/banners/banner-bg-1.jpg') }});">
                <div class="banner-list-content">
                    <h2><a href="#">Electronics</a></h2>

                    <ul>
                        <li><a href="#">Cell Phones</a></li>
                        <li><a href="#">Computers</a></li>
                        <li><a href="#">TV & Video</a></li>
                        <li><a href="#">Smart Home</a></li>
                        <li><a href="#">Audi</a></li>
                        <li><a href="#">Home Audio & Theater</a></li>
                        <li class="list-all-link"><a href="#">See All Departments</a></li>
                    </ul>
                </div><!-- End .banner-list-content -->
            </div><!-- End .col-sm-6 -->

            <div class="col-sm-6 col-xl-12 col-xxl-6">
                <div class="banner banner-overlay">
                    <a href="#">
                        <img src="{{asset('themes/molla/assets/images/demos/demo-14/banners/banner-5.jpg')}}" alt="Banner img desc">
                    </a>

                    <div class="banner-content">
                        <h4 class="banner-subtitle text-white"><a href="#">Best Deals</a></h4><!-- End .banner-subtitle -->
                        <h3 class="banner-title text-white"><a href="#">Canon EOS <br>Mega Sale <br><span>Up To 20% Off</span></a></h3><!-- End .banner-title -->
                        <a href="#" class="banner-link">Shop Now <i class="icon-long-arrow-right"></i></a>
                    </div><!-- End .banner-content -->
                </div><!-- End .banner -->
            </div><!-- End .col-sm-6 -->
        </div><!-- End .cat-banner -->
    </div><!-- End .col-xl-3 -->

    <div class="col-xl-9 col-xxl-8">
        <div class="owl-carousel owl-full carousel-equal-height carousel-with-shadow" data-toggle="owl" data-owl-options='{
                                        "nav": true, 
                                        "dots": false,
                                        "margin": 20,
                                        "loop": false,
                                        "responsive": {
                                            "0": {
                                                "items":2
                                            },
                                            "480": {
                                                "items":2
                                            },
                                            "768": {
                                                "items":3
                                            },
                                            "992": {
                                                "items":4
                                            },
                                            "1200": {
                                                "items":3
                                            },
                                            "1600": {
                                                "items":4
                                            }
                                        }
                                    }'>
            <div class="product text-center">
                <figure class="product-media">
                    <span class="product-label label-top">Top</span>
                    <a href="product.html">
                        <img src="{{ asset('themes/molla/assets/images/demos/demo-14/products/product-6.jpg') }}" alt="Product image" class="product-image">
                    </a>

                    <div class="product-action-vertical">
                        <a href="#" class="btn-product-icon btn-wishlist" title="Add to wishlist"><span>add to wishlist</span></a>
                        <a href="popup/quickView.html" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
                        <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
                    </div><!-- End .product-action-vertical -->

                    <div class="product-action">
                        <a href="#" class="btn-product btn-cart" title="Add to cart"><span>add to cart</span></a>
                    </div><!-- End .product-action -->
                </figure><!-- End .product-media -->

                <div class="product-body">
                    <div class="product-cat">
                        <a href="#">Laptops</a>
                    </div><!-- End .product-cat -->
                    <h3 class="product-title"><a href="product.html">MacBook Pro 13" Display, i5</a></h3><!-- End .product-title -->
                    <div class="product-price">
                        $1,199.99
                    </div><!-- End .product-price -->
                    <div class="ratings-container">
                        <div class="ratings">
                            <div class="ratings-val" style="width: 100%;"></div><!-- End .ratings-val -->
                        </div><!-- End .ratings -->
                        <span class="ratings-text">( 4 Reviews )</span>
                    </div><!-- End .rating-container -->
                </div><!-- End .product-body -->
            </div><!-- End .product -->

        </div><!-- End .owl-carousel -->
    </div><!-- End .col-xl-9 -->
</div><!-- End .row cat-banner-row -->