<ul class="menu-vertical sf-arrows">
    <li class="megamenu-container">
        @if (count($attr->subcat) > 0)
            <a class="sf-with-ul" href="{{ url('shops-by-category/' . $attr->id) }}"><i class="icon-blender"></i>
                {{ $attr->cat_name }}</a>
            <div class="megamenu">
                <div class="row no-gutters">
                    <div class="col-md-8">
                        <div class="menu-col">
                            <div class="row">
                                @if (count($attr->subcat))
                                    @foreach ($attr->subcat as $item)
                                        <div class="col-md-6">
                                            <div class="menu-title"><a
                                                    href="{{ url('shops-by-category/' . $item->id) }}">
                                                    {{ $item->cat_name }} </a></div><!-- End .menu-title -->
                                            @if (count($item->subcat))
                                                @foreach ($item->subcat as $item1)
                                                    <ul>
                                                        <li><a
                                                                href="{{ url('shops-by-category/' . $item1->id) }}"><strong>{{ $item1->cat_name }}</strong></a>
                                                        </li>
                                                    </ul>
                                                @endforeach
                                            @endif
                                        </div><!-- End .col-md-6 -->
                                    @endforeach
                                @endif
                            </div><!-- End .row -->
                        </div><!-- End .menu-col -->
                    </div><!-- End .col-md-8 -->

                    <div class="col-md-4">
                        <div class="banner banner-overlay">
                            <a href="category.html" class="banner banner-menu">
                                <img src="{{ asset('themes/molla/assets/images/demos/demo-13/menu/banner-2.jpg') }}"
                                    alt="Banner">
                            </a>
                        </div><!-- End .banner banner-overlay -->
                    </div><!-- End .col-md-4 -->
                </div><!-- End .row -->
            </div><!-- End .megamenu -->
        @endif
        @if (count($attr->subcat) == null)
            <a href="{{ url('shops-by-category/' . $attr->id) }}"><i class="icon-blender"></i> {{ $attr->cat_name }}</a>
        @endif
    </li>
</ul>