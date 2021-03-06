@extends('themes.molla.layouts.app')
@section('title','Checkout As a Guest')
@section('contant')
<main class="main">
	<div class="page-header text-center" style="background-image: url('themes/molla/assets/images/page-header-bg.jpg')">
		<div class="container">
			<h1 class="page-title">Checkout As a Guest<span>Shop</span></h1>
		</div><!-- End .container -->
	</div><!-- End .page-header -->
	<nav aria-label="breadcrumb" class="breadcrumb-nav">
		<div class="container">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
				<li class="breadcrumb-item"><a href="#">Shop</a></li>
				<li class="breadcrumb-item active" aria-current="page">Checkout as a Guest</li>
			</ol>
		</div><!-- End .container -->
	</nav><!-- End .breadcrumb-nav -->

	<div class="page-content">
		<div class="checkout">
			<div class="container">
				<div class="checkout-discount">
					<form action="#">
						<input type="text" class="form-control" required id="checkout-discount-input">
						<label for="checkout-discount-input" class="text-truncate">Have a coupon? <span>Click here to enter your code</span></label>
					</form>
				</div><!-- End .checkout-discount -->
				<form action="{{ route('guest.checkout') }}" method="POST">
					@csrf
					<div class="row">
						<div class="col-lg-9">
							<h2 class="checkout-title">Billing Details</h2><!-- End .checkout-title -->
							<div class="row">
								<div class="col-sm-6">
									<label>First Name *</label>
									<input type="text" name="fname" class="form-control" required>
								</div><!-- End .col-sm-6 -->

								<div class="col-sm-6">
									<label>Last Name *</label>
									<input type="text" name="lname" class="form-control" required>
								</div><!-- End .col-sm-6 -->
							</div><!-- End .row -->


							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label for="province_id">Select A province</label>
										<select class="form-control" data-live-search="true" id="province_id" name="province_id" data-style="btn btn-primary " title="Select a Province" data-size="7" required style="border:1px solid #b6b6b6;">
											<option></option>
											@foreach (\App\Province::all() as $province)
											<option value="{{ $province->id }}">{{ $province->name }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="district_id">Select a District</label>

										<select class="form-control" data-live-search="true" id="district_id" name="district_id" data-style="btn btn-primary " title="Select a District" data-size="7" required style="border:1px solid #b6b6b6;">
											<option> </option>

										</select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="municipality_id"> Select a Munucipality</label>

										<select class="form-control" data-live-search="true" id="municipality_id" name="municipality_id" data-style="btn btn-primary " title="Select Province" data-size="7" required style="border:1px solid #b6b6b6;">
											<option> </option>

										</select>
									</div>
								</div>
							</div><!-- End .row -->

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="municipality_id">Select a Shipping Zone</label>

										<select class="form-control" data-live-search="true" id="shipping_area_id" name="shipping_area_id" data-style="btn btn-primary " title="Select Province" data-size="7" required style="border:1px solid #b6b6b6;">
											<option></option>

										</select>
									</div>
								</div>

								<div class="col-sm-6">
									<label>Phone *</label>
									<input type="tel" class="form-control" name="phone" required>
								</div><!-- End .col-sm-6 -->
							</div><!-- End .row -->

							<label>Email address *</label>
							<input type="email" name="email" class="form-control" required>


							<label>Order notes (optional)</label>
							<textarea class="form-control" cols="30" rows="4" name="order_message" placeholder="Notes about your order, e.g. special notes for delivery"></textarea>
						</div><!-- End .col-lg-9 -->
						<aside class="col-lg-3">
							<div class="summary">
								<h3 class="summary-title">Your Order</h3><!-- End .summary-title -->
								@php
								$simpletotal = 0;
								$varianttotal = 0;
								$extraCharge = 0;
								$session_id = Session::get('session_id');
								$cartItem = \App\model\Cart::where('session_id',$session_id)->get();
								@endphp
								<table class="table table-summary">
									<thead>
										<tr>
											<th>Product</th>
											<th>Total</th>
										</tr>
									</thead>

									<tbody>
										@foreach($cartItem as $k => $item)
										@php
										$price = \App\model\ProductStock::where('product_id',$item->product_id)->where('code',$item->variant_code)->select('price')->first();
										if($item->product->stocktype == 1){
										$varianttotal = $varianttotal + $item->qty * $price->price;
										}else{
										$simpletotal = $simpletotal + $item->product->sell_price * $item->qty;
										}
										@endphp
										<tr>
											<td>{{ $k+1}}. <a href="{{route('product.detail',$item->product_id)}}">{{ $item->product->product_name }}</a></td>
											<td>
												@if($item->product->stocktype == 0)
												NPR.{{ $item->product->sell_price }}
												@else
												NPR.{{ $price->price }}
												@endif
												x {{ $item->qty }}
											</td>
										</tr>
										@php 
										    $extraFeatureCount = \App\ExatraChargeCart::where('cart_id',$item->id)->count();
											$extraFeature = \App\ExatraChargeCart::where('cart_id',$item->id)->get();
											if($extraFeatureCount>0){
												foreach($extraFeature as $f){
													$extraCharge = $extraCharge + $f->amount;
												}
											}
										@endphp
										@endforeach
										<tr class="summary-subtotal">
											<td>Subtotal:</td>
											<td>NPR.{{ $varianttotal + $simpletotal }}</td>
										</tr><!-- End .summary-subtotal -->
										@if($extraCharge>0)
										<tr class="summary-subtotal">
											<td>Extra Feature Charge:</td>
											<td>NPR.{{ $extraCharge }}</td>
										</tr><!-- End .summary-subtotal -->
										@endif
										    @php
												$discount=Session::get('couponAmount', 0);
											@endphp
											@if($discount>0)
											<tr class="summary-subtotal">
	                							<td>coupon Discount:</td>
	                							<td>NPR.{{ $discount }}</td>
											</tr><!-- End .summary-subtotal -->
											@endif
										<tr>
											<td colspan="2">
												<div id="shipping-charge" class="text-left">
													<h6>Please Select Shipping Detail To View Shipping Charge.</h6>
												</div>
											</td>
										</tr>
										<tr class="summary-total">
											<td>Grand Total:</td>
											<td id="showTotal">NPR.{{ $varianttotal + $simpletotal + $extraCharge - $discount }}</td>
										</tr><!-- End .summary-total -->
										<input type="hidden" id="gtotal" value="{{ $varianttotal + $simpletotal + $extraCharge-$discount }}">

										<tr>
											<td>Delivery Method</td>
											<td>
												<select name="delivery_type" id="delivery_type">
													<option value="0">Normal</option>
													<option value="1">Express</option>
												</select>
											</td>
										</tr><!-- End .summary-total -->
									</tbody>
								</table><!-- End .table table-summary -->

								<div class="accordion-summary" id="accordion-payment">

									

								</div><!-- End .accordion -->

								<button type="submit" class="btn btn-outline-primary-2 btn-order btn-block">
									<span class="btn-text">Place Order</span>
									<span class="btn-hover-text">Proceed to Place Order</span>
								</button>
							</div><!-- End .summary -->
						</aside><!-- End .col-lg-3 -->
					</div><!-- End .row -->
				</form>
			</div><!-- End .container -->
		</div><!-- End .checkout -->
	</div><!-- End .page-content -->
</main><!-- End .main -->
@endsection

@section('js')
    <script>
        district = {!!\App\ District::all()->toJson() !!}
        municipality = {!!\App\ Municipality::all()->toJson() !!}
        area = {!!\App\ ShippingArea::all()->toJson() !!}


        $('#province_id').change(function() {
            province_id = $('#province_id').val();

            str = "<option> </option>";
            district.forEach(element => {

                if (element.province_id == province_id) {

                    str += "<option value='" + element.id + "'>" + element.name + "</option>";
                }
            });
            $('#district_id').html(str);
            $('#municipality_id').html("<option> </option>");
            $('#shipping_area_id').html("<option> </option>");

        });
        $('#district_id').change(function() {
            district_id = $('#district_id').val();

            str = "<option></option>";
            municipality.forEach(element => {

                if (element.district_id == district_id) {

                    str += "<option value='" + element.id + "'>" + element.name + "</option>";
                }
            });

            $('#municipality_id').html(str);
            $('#shipping_area_id').html("<option> </option>");

        });
        $('#municipality_id').change(function() {
            municipality_id = $('#municipality_id').val();

            str = "<option> </option>";
            area.forEach(element => {

                if (element.municipality_id == municipality_id) {

                    str += "<option value='" + element.id + "'>" + element.name + "</option>";
                }
            });


            $('#shipping_area_id').html(str);

        });


		// get shipping charge

		$('#shipping_area_id').on('change', function(e){
			var p_id = $('#province_id').val();
			var d_id = $('#district_id').val();
			var m_id = $('#municipality_id').val();
		    var gTotal = parseInt($('#gtotal').val());
			var shipping_area_id = e.target.value;
			axios.get('/shipping/charge/'+p_id+'/'+d_id+'/'+m_id+'/'+shipping_area_id)
			.then(function (response) {
				var data = response.data;
				$("#shipping-charge").html(data);
				var totalShipping = parseInt($('#totalShipping').val());
				var grandTotal = gTotal+totalShipping;
				$('#showTotal').text("NPR."+grandTotal);
			// console.log(data);
			})
			.catch(function (error) {
				console.log(error);
			})
		});

    </script>

@endsection