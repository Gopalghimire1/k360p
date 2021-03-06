<div class="product text-center">
    <figure class="product-media" >
        @php
        $onsale=$product->onSale();
        @endphp
        @if ($product->promo == 1 || $onsale)
            @if ($onsale)
                @php
                $sellproduct=$product->sale();
                $sell=$sellproduct->onsale;
                @endphp
                <span class="product-label label-sale "><a href="{{ route('public.sale.detail', $sell->sell_id) }}"
                        style="color:white;font-weight: 400">
                        <span class="d-none d-md-inline">
                            {{ $sell->sell_name }}
                        </span>
                        <span class="ml-2">- {{ $sellproduct->sale_discount }}%</span>
                    </a></span>
            @else
                <span class="product-label label-sale">Promotion</span>

            @endif

        @endif
        @if ($product->isnew())
            <span class="product-label label-new"><a href="{{route('latest')}}" style="color:white;"> New </a></span>
        @endif
        @if ($product->isTop())
            <span class="product-label label-top">Top</span>
        @endif
        <a href="/product/{{ $product->product_id }}" style="margin: auto 0;display:flex;height:100%;">
            <img src="{{ asset($product->product_images) }}" alt="Product image" class="product-image" style="margin:auto;">
        </a>

        <div class="product-action-vertical">
            <a href="{{ route('user.wishlist', $product->product_id) }}" class="btn-product-icon btn-wishlist"
                title="Add to wishlist"><span>add to
                    wishlist</span></a>
            <a href="popup/quickView.html" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick
                    view</span></a>
            {{-- <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a> --}}
        </div><!-- End .product-action-vertical -->

        <div class="product-action text-center d-none d-md-block">

            @if ($product->stocktype == 0)
                @if ($product->quantity>0)

                <form action="{{ route('public.cart') }}" method="POST" class="w-100">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                    <input type="hidden" name="type" value="{{ $product->stocktype }}">
                    <input type="hidden" name="qty" value="1">

                    @if ($product->promo == 0 && !$onsale)

                        <input type="hidden" name="rate" value="{{ $product->mark_price }}">

                    @else
                        @if ($onsale)
                            <input type="hidden" name="rate" value="{{ $product->salePrice() }}">
                        @else
                            <input type="hidden" name="rate" value="{{ $product->$product->sell_price() }}">
                        @endif

                    @endif

                    <button class="btn-product btn-cart w-100"><span>add to cart</span></button>
                    <!-- <span onclick="javascript:this.form.submit();" class="btn-product btn-cart"><span>add to cart</span></span> -->
                </form>
                @else
                    <button class="btn-product btn-cart w-100"><span>Out Of Stock</span></button>

                @endif
            @else
                <a href="{{ route('product.detail', $product->product_id) }}" class="btn-product btn-cart "><span>View
                        Detail</span></a>
            @endif



        </div><!-- End .product-action -->
    </figure><!-- End .product-media -->

    <div class="product-body">
        <div class="product-cat">
            <a href="{{route('shop-by-category',['id'=>$product->category->cat_id])}}">{{ $product->category->cat_name }}</a>
        </div><!-- End .product-cat -->
        <h3 class="product-title"><a href="{{ route('product.detail', ['id'=>$product->product_id]) }}">{{ $product->product_name }}</a>
        </h3>
        <!-- End .product-title -->
        <div class="product-price">
            @if ($product->stocktype == 0)
                @if ($product->promo == 0 && !$onsale)
                    Rs. {{ $product->mark_price }}
                @else
                    @if ($onsale)
                        <span class="new-price">Rs. {{ $product->salePrice() }} </span>
                    @else
                        <span class="new-price">Rs. {{ $product->sell_price }} </span>
                    @endif
                    <span class="old-price">Was <span style="text-decoration: line-through;">Rs.
                            {{ $product->mark_price }}</span></span>
                @endif
            @else

            @endif

        </div><!-- End .product-price -->
        <div class="ratings-container ">
            <div class="ratings d-none d-md-inline">
            <div class="ratings-val" style="width: {{$product->avgRating()}}%;"></div><!-- End .ratings-val -->
            </div><!-- End .ratings -->
            <span class="d-inline-block d-md-none">
                <i class="la la-star"></i> {{$product->avgRating()/20}} .
            </span>
            <span class="ratings-text">( {{$product->reviewCount()}} Reviews )</span>
        </div><!-- End .rating-container -->
    </div><!-- End .product-body -->
</div><!-- End .product -->
