@extends('layouts.sellerlayouts.seller-design')
@section('content')
    @php
    $sel=1;
    if(session('sel')){
    $sel=session('sel');
    }
    @endphp
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">

                            <strong><a href="{{ url('vendor/manage-product') }}">Products</a> /
                                {{ $productdetail->product_name }}</strong>
                        </h4>
                    </div>
                    <div class="card-content">
                        <div class="row">
                            <div class="col-md-2">
                                <ul class="nav nav-pills nav-pills-icons nav-pills-rose nav-stacked" role="tablist">
                                    <li class="{{ $sel == 1 ? 'active' : '' }}">
                                        <a href="#general-info" role="tab" data-toggle="tab" aria-expanded="false">
                                            <i class="material-icons">info</i> General Info
                                        </a>
                                    </li>
                                    <li class="{{ $sel == 2 ? 'active' : '' }}">
                                        <a href="#productimages" role="tab" data-toggle="tab" aria-expanded="true">
                                            <i class="material-icons">photo_library</i> Images Gallery
                                        </a>
                                    </li>
                                    <li class="{{ $sel == 3 ? 'active' : '' }}">
                                        <a href="#productattribute" role="tab" data-toggle="tab" aria-expanded="true">
                                            <i class="material-icons">notes</i> Stock
                                        </a>
                                    </li>
                                    <li class="{{ $sel == 4 ? 'active' : '' }}">
                                        <a href="#productshipping" role="tab" data-toggle="tab" aria-expanded="true">
                                            <i class="material-icons">local_shipping</i> Shipping
                                        </a>
                                    </li>
                                    <li class="{{ $sel == 5 ? 'active' : '' }}">
                                        <a href="#extra" role="tab" data-toggle="tab" aria-expanded="true">
                                            <i class="material-icons">bento</i> Extra Details
                                        </a>
                                    </li>
                                    <li class="{{$sel==6?"active":""}}">
                                        <a href="#extracharge" role="tab" data-toggle="tab" aria-expanded="true">
                                            <i class="material-icons">attach_money
                                            </i> Extra Charges
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-10">
                                <div class="tab-content">
                                    <div class="tab-pane {{ $sel == 1 ? 'active' : '' }}" id="general-info">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h2 style="text-transform: uppercase;"><strong>General Info</strong></h2>
                                            
                                            </div>
                                            <div class="col-md-6"><img class="img img-responsive img-round"
                                                    style="max-width: 120px;"
                                                    src="{{ asset($productdetail->product_images) }}" alt=""></div>
                                        </div>
                                        <hr>
                                        <form onsubmit="return false;" class="form-horizontal">
                                            <div class="row">
                                                <label class="col-md-2 label-on-right text-primary">Product Link</label>
                                                <div class="col-md-6">
                                                    <div class="form-group label-floating is-empty">
                                                        <label class="control-label"></label>
                                                        <input type="text" class="form-control"
                                                            value="{{ url('/product/' . $productdetail->product_id) }}"
                                                            id="prodlink">
                                                        <span class="material-input"></span></div>
                                                </div>
                                                <div class="col-md-4">
                                                    <button onclick="selectLink()"
                                                        class="btn btn-round btn-primary">Copy</button>
                                                </div>
                                            </div>
                                        </form>
                                        <hr>
                                        <style>
                                            .cc {
                                                border: none;
                                                width: 100%;
                                            }

                                            .cc:focus {
                                                border: black 1px solid;
                                            }

                                        </style>

                                        <form
                                            action="{{ route('vendor.update-product', ['product' => $productdetail->product_id]) }}"
                                            method="post">
                                            @csrf
                                            <p class="prod-desc"><strong>Name: </strong>
                                                <input value="{{$productdetail->product_name}}" type="text" name="product_name" id="P_name" required class="cc">

                                            </p>
                                            <p class="prod-desc"><strong>Stock Type: </strong>
                                                <select name="stocktype" id="stocktype" class="cc">
                                                    <option value="0"
                                                        {{ $productdetail->stocktype == 0 ? 'selected' : '' }}>
                                                        Simple</option>
                                                    <option value="1"
                                                        {{ $productdetail->stocktype == 1 ? 'selected' : '' }}>
                                                        Variant</option>
                                                </select>

                                            </p>
                                            <p class="prod-desc"><strong>Description: </strong>
                                                <textarea name="product_short_description" id="product_short_description"
                                                    class="cc">{{ $productdetail->product_short_description }}</textarea>

                                            </p>
                                            <p class="prod-desc"><strong>Category: </strong>
                                                {{-- <span class="label label-rose">
                                                    {{ $productdetail->parent_category }}</span></p>
                                            --}}
                                            <select name="category_id" id="category_id" class="cc">
                                                {!! $categorydropdown !!}
                                            </select>
                                            </p>
                                            <p class="prod-desc"><strong>Brand: </strong>
                                                <select name="brand_id" id="brand_id" class="cc">
                                                    {!! $branddropdown !!}
                                                </select>
                                            </p>
                                            {{-- <p class="prod-desc"><strong>Stock Status:
                                                </strong>{{ $productdetail->stockstatus }}</p>
                                            --}}
                                            <p class="prod-desc"><strong>Cost Price (Rs) :</strong>
                                                <input required type="number" min="0" name="costprice"
                                                    value="{{ $productdetail->costprice }}" class="cc"
                                                    placeholder="Enter Product Price">


                                            </p>
                                            <p class="prod-desc"><strong>Mark Price (Rs) :</strong>
                                                <input required type="number" step="0.01" name="mark_price"
                                                    value="{{ $productdetail->mark_price }}" class="cc"
                                                    placeholder="Enter Product Price">


                                            </p>
                                            <p class="prod-desc"><strong>Sale Price (Rs) : </strong>
                                                <input required type="number" step="0.01" name="sell_price"
                                                    value="{{ $productdetail->sell_price }}" class="cc"
                                                    placeholder="Enter Product Price">
                                            </p>
                                            <p class="prod-desc"><strong>Tags: </strong>
                                            <div class="cc">
                                                <input value="{{ $productdetail->tags }}" name="tags" class="cc" required
                                                    data-role="tagsinput" name="attributeitem" id="attributeitem"
                                                    required />
                                            </div>


                                            </p>
                                            @if ($productdetail->stocktype == 0)

                                                <p class="prod-desc"><strong>Quantity: </strong>
                                                    <input required type="number" step="0.01" name="quantity"
                                                        value="{{ $productdetail->quantity }}" class="cc"
                                                        placeholder="Enter Product Price">


                                                </p>
                                            @endif

                                            <p class="prod-desc"><strong>Can Bundle: </strong>
                                                
                                                @if ($productdetail->canbundle == 1)
                                                    <span id="featured_text" class="label label-primary">Can Bundle</span>
                                                @else
                                                    <span id="featured_text" class="label label-danger">Cannot Bundle</span>
                                                @endif
                                                <span>( Request Admin To Change Bundle Info )</span>
                                            </p>
                                            <p class="prod-desc"><strong>Featured: </strong>
                                                <input type="checkbox" name="featured" id="featured" {{$productdetail->featured == 1?"checked":""}} value="1">
                                                @if ($productdetail->featured == 1)
                                                    <span id="featured_text" class="label label-primary">Featured</span>

                                                @else
                                                    <span id="featured_text" class="label label-danger">Not Featured</span>
                                                @endif
                                            </p>
                                            <p>
                                            <div>
                                                <div class="prod-desc">
                                                    <strong>Description</strong>
                                                </div>
                                                <hr>
                                                <div>
                                                    <textarea id="product-desc" class="cc"
                                                        name="product_description" required>{!!  $productdetail->product_description !!}</textarea>
                                                </div>
                                            </div>
                                            </p>
                                            <p>
                                                <input type="submit" value="Update Product" class="btn btn-primary">
                                            </p>
                                        </form>
                                    </div>
                                    <div class="tab-pane {{ $sel == 2 ? 'active' : '' }}" id="productimages">
                                        <h3>PRODUCT IMAGES</h3>
                                        <hr>
                                        <div class="row">
                                            @foreach ($productimages as $productimage)
                                                <div class="col-md-4 fileinput">
                                                    <div style="position: relative;">

                                                        <div class="thumbnail">
                                                            <img src="{{ asset($productimage->image) }}" alt="">
                                                        </div>
                                                        <div style="position: absolute;top:0;right:0;">
                                                            <a href="{{ url('vendor/product-image/del/' . $productimage->product_image_id) }}"
                                                                class="btn btn-danger">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div>
                                            <form
                                                action="{{ url('vendor/product-image/add/' . $productdetail->product_id) }}"
                                                enctype="multipart/form-data" method="POST">
                                                @csrf
                                                <label for="images">Add Gallery Images (800 x 600)</label>
                                                <div class="row" id="images">
                                                    @for ($i = 0; $i < env('productimage_count') - count($productimages); $i++)
                                                        <div class="col-md-4 h-100"
                                                            style="margin-bottom: 5px;min-height:180px;">
                                                            <div style="position: relative">
                                                                <div>
                                                                    <input onchange="loadImage(this,{{ $i }})" v="{{ $i }}"
                                                                        style="display:none;" name="product_images[]"
                                                                        type="file" id="gal_{{ $i }}" accept="image/*" />
                                                                    <img src="{{ asset('images/backend_images/add_image.png') }}"
                                                                        alt="..." id="gal_img_{{ $i }}"
                                                                        onclick="document.getElementById('gal_{{ $i }}').click();">
                                                                </div>
                                                                <div style="position: absolute;top:0px;right:0px;">
                                                                    <span class="btn btn-danger" onclick="
                                                                        document.getElementById('gal_{{ $i }}').value = null;
                                                                        document.getElementById('gal_img_{{ $i }}').src='{{ asset('images/backend_images/add_image.png') }}';
                                                                        ">Clear</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endfor
                                                </div>
                                                <div style="margin-bottom: 5px;min-height:180px;">
                                                    <button class="btn  btn-primary">Save Image</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                    <div class="tab-pane {{ $sel == 3 ? 'active' : '' }}" id="productattribute">
                                        <h3>ATTRIBUTES</h3>
                                        <hr>
                                        @if ($productdetail->stocktype == 1)
                                            @include('vendor.product.VariantStock')
                                        @else
                                        @include('vendor.product.SimpleStock')

                                        @endif
                                    </div>
                                    <div class="tab-pane {{ $sel == 4 ? 'active' : '' }}" id="productshipping">
                                        @include('vendor.product.shipping')
                                    </div>
                                    <div class="tab-pane {{ $sel == 5 ? 'active' : '' }}" id="extra">
                                        @include('vendor.product.detail')

                                    </div>
                                    <div class="tab-pane {{$sel==6?"active":""}}" id="extracharge" >
                                        @include('vendor.product.extracharge')
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('js/backend-js/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('product-desc');

        function selectLink() {
            var copylink = document.getElementById("prodlink");
            copylink.select();
            document.execCommand("copy");
            copyLink('top', 'right');
        }

        function copyLink(from, align) {
            type = ['', 'info', 'success', 'warning', 'danger', 'rose', 'primary'];

            color = Math.floor((Math.random() * 6) + 1);

            $.notify({
                icon: "notifications",
                message: "Link has been <b>Copied</b> to clipboard"

            }, {
                type: type[color],
                delay: 2000,
                timer: 200,
                placement: {
                    from: from,
                    align: align
                }
            });
        }

        function loadImage(input, i) {
            console.log(input, i);
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#gal_img_' + i).attr('src', e.target.result);
                }
                var FileSize = input.files[0].size / 1024;
                if (FileSize > {{env('productimage_size')}}) {
                    alert('Image Size Cannot Be Greater than 600kb');
                    document.getElementById('gal_img_' + i).src = '{{ asset('images/backend_images/add_image.png')}}';
                    input.value = null;
                    console.log(input.files);
                } else {

                    reader.readAsDataURL(input.files[0]); // convert to base64 string
                }
            }
        }

        $("#attribute").change(function() {
            $('#attributeitem').tagsinput('removeAll');
            var selecteditem = $(this).children("option:selected").data("id");
            var items = selecteditem.split(",");
            for (let index = 0; index < items.length; index++) {
                const item = items[index];
                $('#attributeitem').tagsinput('add', item);
                console.log(item);
            }
        });

        $("#featured").change(function(){
            if($(this).prop( "checked")){
                $("#featured_text").text("Featured");
                $("#featured_text").removeClass( "label-danger" );
                $("#featured_text").addClass( "label-primary" );
            }else{
                $("#featured_text").text("Not Featured");
                $("#featured_text").removeClass( "label-primary" );
                $("#featured_text").addClass( "label-danger" );
            }
            
        });

    </script>
@endsection
