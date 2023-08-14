<div class="page-content">
	<div class="cart">
		<div class="container">
			<div class="row">
				<div class="col-lg-9">
					<table class="table table-cart table-mobile">
						<thead>
							<tr>
								<th>Product</th>
								<th>Price</th>
								<th style="display: block; text-align: center;width: 70px;">Quantity</th>
								<th>Total</th>
								<th> Delete</th>
							</tr>
						</thead>

						<tbody>
							@if (count($list_carts) > 0 || $list_carts != null)
								@foreach($list_carts as $item) 
									<tr>
										<td class="product-col">
											<div class="product">
												<figure class="product-media">
													<a href="<?php echo $item['Value'] ?>">
														<img src="<?php echo  $item['Value'] ?>" alt="Product image">
													</a>
												</figure>

												<h3 class="product-title">
													<a href=""> {{$item['Name']}}</a>
												</h3><!-- End .product-title -->
											</div><!-- End .product -->
										</td>
										<td class="price-col">{{$item['Price']}}</td>
										<td class="quantity-col">
											<div class="cart-product-quantity">
												<input type="number" min="1" max="100" style="display: block; text-align: center;" name="quantity" class=" " value ='{{$item['Quantity']}}'  >
											</div><!-- End .cart-product-quantity -->
										</td>
										<td style="    width: 112px; " class="total-col">{{$item['Total']}}</td>
										<td style=" padding: 25px;">
											<a href=''>
												<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
													<style>
														svg {
															fill: #ce5050
														}
													</style>
													<path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z" />
												</svg>
											</a>
										</td>
									</tr>
									<tr>
										
									</tr>
									@endforeach
									@endif
						</tbody>

					</table><!-- End .table table-wishlist -->

					<div class="cart-bottom">
						<!-- <div class="cart-discount">
							<form action="" method="">
								<div class="input-group">
									<input type="text" class="form-control" required placeholder="coupon code">
									<div class="input-group-append">
										<button class="btn btn-outline-primary-2" type="submit"><i class="icon-long-arrow-right"></i></button>
									</div>
								</div>
							</form>
						</div>End .cart-discount -->
						<div style=" border: 1px #c96;   margin-left: 680px;">
							<a style="color: #ce5050; " href="?mod=cart&act=delete_all"> Delete all</a>
						</div>
					</div><!-- End .cart-bottom -->
				</div><!-- End .col-lg-9 -->
				<aside class="col-lg-3">
					<div class="summary summary-cart">
						<h3 class="summary-title">Cart Total</h3><!-- End .summary-title -->

						<table class="table table-summary">
							
							<tbody>
								<tr class="summary-subtotal">
									<td style="width: 100px; "> Subtotal:</td>
									<td style=" color: #c96"> 
										@php $Total = 0; 
											foreach($list_carts as $item) $Total = $Total + $item['Total'];
											echo $Total;
										@endphp
										</td>
								</tr><!-- End .summary-subtotal -->
								<tr class="summary-shipping">
									<td>Shipping:</td>
									<td>&nbsp;</td>
								</tr>
								<form action="" method="post">
													
									<tr class="summary-shipping-row">
										<td>
											<div class="custom-control custom-radio">
												<input type="radio" id="free-shipping" name="shipping" class="custom-control-input">
												<label class="custom-control-label" for="free-shipping">Ha Noi</label>
											</div><!-- End .custom-control -->
										</td>
										<td>20000</td>
									</tr><!-- End .summary-shipping-row -->

									<tr class="summary-shipping-row">
										<td>
											<div class="custom-control custom-radio">
												<input type="radio" id="standart-shipping" name="shipping" class="custom-control-input" checked>
												<label style="width:126px" class="custom-control-label" for="standart-shipping">Ho Chi Minh</label>
											</div><!-- End .custom-control -->
										</td>
										<td>30000</td>
									</tr><!-- End .summary-shipping-row -->

									<tr class="summary-shipping-row">
										<td>
											<div class="custom-control custom-radio">
												<input type="radio" id="express-shipping" name="shipping" class="custom-control-input">
												<label class="custom-control-label" for="express-shipping">Other</label>
											</div><!-- End .custom-control -->
										</td>
										<td>40000</td>
									</tr><!-- End .summary-shipping-row -->
								</form>

								<tr class="summary-total">
									<td>Total:</td>
									<td>
										@php $Total = 0; 
											foreach($list_carts as $item) $Total = $Total + $item['Total'];
											echo $Total;
										@endphp
										
									</td>
								</tr><!-- End .summary-total -->
							</tbody>
						</table><!-- End .table table-summary -->

						<a href="?mod=cart&act=checkout" class="btn btn-outline-primary-2 btn-order btn-block">PROCEED TO CHECKOUT</a>
					</div><!-- End .summary -->

				</aside><!-- End .col-lg-3 -->
			</div><!-- End .row -->
		</div><!-- End .container -->
	</div><!-- End .cart -->
</div><!-- End .page-content -->