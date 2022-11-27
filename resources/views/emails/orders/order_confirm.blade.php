<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; background-color: #f5f8fa; color: #74787e; height: 100%; hyphens: auto; line-height: 1.4; margin: 0; -moz-hyphens: auto; -ms-word-break: break-all; width: 100% !important; -webkit-hyphens: auto; -webkit-text-size-adjust: none; word-break: break-word;">
	<style>
		@media  only screen and (max-width: 600px) {
			.inner-body {
				width: 100% !important;
			}

			.footer {
				width: 100% !important;
			}
		}

		@media  only screen and (max-width: 500px) {
			.button {
				width: 100% !important;
			}
		}
	</style>
	<table class="wrapper" width="100%" cellpadding="0" cellspacing="0" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; background-color: #f5f8fa; margin: 0; padding: 0; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;">
		<tr>
			<td align="center" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">
				<table class="content" width="100%" cellpadding="0" cellspacing="0" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; margin: 0; padding: 0; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;">
					<tr>
						<td class="header" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; padding: 25px 0; text-align: center; background: white;">
							<a href="http://yamazakimwz.com/" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #bbbfc3; font-size: 19px; font-weight: bold; text-decoration: none; text-shadow: 0 1px 0 #ffffff;">
								<img src="https://yamazaki.dev.nd.co.th/modules/frontend/img/logo/logo.png">
							</a>
						</td>
					</tr>
					<!-- Email Body -->
					<tr>
						<td class="body" width="100%" cellpadding="0" cellspacing="0" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; background-color: #ffffff; border-bottom: 1px solid #edeff2; border-top: 1px solid #edeff2; margin: 0; padding: 0; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;">
							<table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; background-color: #ffffff; margin: 0 auto; padding: 0; width: 570px; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 570px;">
								<!-- Body content -->
								<tr>
									<td class="content-cell" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; padding: 35px;">
										<h1 style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #2F3133; font-size: 19px; font-weight: bold; margin-top: 0; text-align: left;">Hi, {{ $event->member->name }}<br>Thank you for your order.</h1>
										<p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 14px; line-height: 1.5em; margin-top: 0; text-align: left;">We have received your order has been fully delivered with details as below.
											<br>If you have made a Pre-payment, your payment is confirmed. <br> 
											You can check the status of your order by Login to <a href="#">My Account</a>.
										</p>
										<h2 style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #2F3133; font-size: 16px; font-weight: bold; margin-top: 0; text-align: left;">ORDER CONFIRMATION</h2>

										<h2 style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #2F3133; font-size: 15px; font-weight: 500;text-align: left; background-color: #edeff2; padding: 20px; margin: 0;">
											ORDER DATE. <strong style="color: #333;float: right;">{{ $event->order['order_date'] }}</strong><br>
											ORDER NUMBER. <strong style="color: #333;float: right;">{{ $event->order['order_id'] }}</strong><br>
											<!-- PAYMENT METHOD. <strong style="color: #333;float: right;">Credit Card</strong>  -->
										</h2>
										
										<div class="table" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">
											<table style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; margin: 20px 0 auto; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;  border-top: 1px solid #191919; border-bottom: 1px solid #191919;">
												<tbody style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; ">
													<tr>
														<td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #333; font-size: 15px; line-height: 18px; padding: 10px 0;height: 102px!important; padding-top: 10px;padding-bottom: 10px;width: 50%;">
															<strong>Yamazaki ID</strong>
															<br>
															{{ $event->member->yamazaki_id }}
															<br>
															<br>
															<strong>Pick Up Branch</strong>
															<br>
															{{ $event->order['pickup_branch'] }}
														</td>
														<td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #333; font-size: 15px; line-height: 18px; padding: 10px 0;height: 102px!important; padding-top: 10px;padding-bottom: 10px;width: 50%;">
															<strong>Contact Info</strong>
															<br>
															{{ $event->member->mobile }}
															<br>
															<br>
															<strong>Pick Up Date</strong>
															<br>
															{{ $event->order['pickup_date'] }}
														</td>
													</tr>
												</tbody>
											</table>
										</div>

										<div class="table" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;  margin: 10px auto;">
											<table style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;">
												<thead style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">
													<tr style="text-align: left;font-family: Avenir, Helvetica, sans-serif; font-size: 12px;color: #333;">
														<th style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; border-bottom: 1px solid #edeff2; padding-bottom: 8px; width:50% ">Product</th>
														<th style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; border-bottom: 1px solid #edeff2; padding-bottom: 8px;text-align: right; width:15%">Quantity</th>
														<th style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; border-bottom: 1px solid #edeff2; padding-bottom: 8px;text-align: right; width:15%">Item Price</th>
														<th style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; border-bottom: 1px solid #edeff2; padding-bottom: 8px;text-align: right; width:20%">Total</th>
													</tr>
												</thead>
												<tbody style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;font-size: 13px;color: #333;">

													@foreach($event->order['order_list_data'] as $k => $v)
													<tr style="line-height: 1.5; font-size: 13px;text-align: right;">
														<td style="width: 45%; text-align: left;">
															<div style="display:block; width:30%; float:left;">
																<img src="https://yamazaki.dev.nd.co.th/{{ $v['images']; }}" style="width:50px; height:50px;">
															</div>
															<div style="display:block; width:70%; float:left;">
															{{ $v['name']; }}<br/>Size : {{ $v['size']; }}
															</div>
														</td>
														<td>{{ $v['quantity']; }}</td>
														<td>฿{{ $v['price']; }}</td>
														<td>฿{{ $v['grand_total']; }}</td>
													</tr>
													@endforeach

													<!-- <tr style="line-height: 1.5; font-size: 13px;text-align: right;">
														<td style="width: 45%; text-align: left;"><span>Pixi </span> +C VIT Priming Oil </td>
														<td>1</td>
														<td>฿990.00</td>
														<td>฿990.00</td>
													</tr>
													<tr style="line-height: 1.5; font-size: 13px;text-align: right;">
														<td style="width: 45%;text-align: left;"><span>FRESH </span> Vitamin Nectar Glow Juice Antioxidant Face Serum 1.5ml., Sachet </td>
														<td>1</td>
														<td>฿990.00</td>
														<td>฿990.00</td>
													</tr>
													<tr style="line-height: 1.5; font-size: 13px;text-align: right;">
														<td style="width: 45%;text-align: left;"><span>Caudalie </span> Vinoperfect Radiance Serum Complexion Correcting 1.5ml., Sachet </td>
														<td>1</td>
														<td>฿990.00</td>
														<td>฿990.00</td>
													</tr> -->

													<tr>
														<td style="border-bottom: 1px solid #edeff2;">&nbsp;</td>
														<td style="border-bottom: 1px solid #edeff2;">&nbsp;</td>
														<td style="border-bottom: 1px solid #edeff2;">&nbsp;</td>
														<td style="border-bottom: 1px solid #edeff2;">&nbsp;</td>
													</tr>
													<tr style="line-height:18px;padding-top:8px; text-align: right;">
														<td>&nbsp;</td>
														<td style="padding-top:6px" colspan="2"><span><span>Subtotal</span></span></td>
														<!-- <td style="padding-top:6px">&nbsp;</td> -->
														<td style="padding-top:6px"><span>฿{{ $event->order['order_sub_total']; }}</span></td>
													</tr>
													<!-- <tr style="line-height:18px;padding-top:8px; text-align: right;">
														<td>&nbsp;</td>
														<td style="padding-top:6px"><span><span>Discount (Code: KPAPR)</span></span></td>
														<td style="padding-top:6px">&nbsp;</td>
														<td style="padding-top:6px"><span>- ฿70.00</span></td>
													</tr> -->
													<!-- <tr style="line-height:18px;padding-top:8px; text-align: right;">
														<td>&nbsp;</td>
														<td style="padding-top:6px"><span><span>VAT</span></span></td>
														<td style="padding-top:6px">&nbsp;</td>
														<td style="padding-top:6px"><span>฿189.72</span></td>
													</tr>
													<tr style="line-height:18px;padding-top:8px; text-align: right;">
														<td>&nbsp;</td>
														<td style="padding-top:6px"><span><span>Shipping Cost</span></span></td>
														<td style="padding-top:6px">&nbsp;</td>
														<td style="padding-top:6px"><span>Free</span></td>
													</tr>
													<tr style="line-height:18px;padding-top:8px; text-align: right;">
														<td>&nbsp;</td>
														<td style="padding-top:6px"><span><span>Points Earned</span></span></td>
														<td style="padding-top:6px">&nbsp;</td>
														<td style="padding-top:6px"><span>139</span></td>
													</tr> -->
													<tr style="line-height:18px;padding-top:8px; text-align: right; font-weight: bold; color:#333;">
														<td>&nbsp;</td>
														<td style="padding-top:6px" colspan="2"><span><span>Grand Total</span></span></td>
														<!-- <td style="padding-top:6px">&nbsp;</td> -->
														<td style="padding-top:6px"><span>฿{{ $event->order['order_grand_total']; }}</span></td>
													</tr>

												</tbody>
											</table>
										</div>

										<!-- <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 14px; line-height: 1.5em; margin-top: 40px; text-align: left; border-top: 1px solid #edeff2; ">Thank you for shopping with us	</p> -->
										<table class="subcopy" width="100%" cellpadding="0" cellspacing="0" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; border-top: 1px solid #edeff2; margin-top: 25px; padding-top: 25px;">
											<tr>
												<td>
													<h3 style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #2F3133; font-size: 14px; font-weight: bold; margin-top: 0; text-align: left; margin-bottom:5px;">Thank you for shopping with us.</h3>
													
												</td>
											</tr>
											<tr>
												<td style="font-family: Avenir, Helvetica, sans-serif;
												box-sizing: border-box;
												font-size: 13px;
												color: #333; padding-bottom:8px;">Customer Service Contact Centre 02-6420405 <br>Working hour: Everyday 09.00 AM. - 18.00 PM.</td>
											</tr>
										<!-- 	<tr>
												<td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">
													<p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; line-height: 1.5em; margin-top: 0; text-align: left; font-size: 12px;">This is an automated message, please do not reply.</p>
												</td>
											</tr> -->
										</table>
									</td>
								</tr>

							</table>
						</td>
					</tr>

					<tr>
						<td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">
							<table class="footer" align="center" width="570" cellpadding="0" cellspacing="0" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; margin: 0 auto; padding: 0; text-align: center; width: 570px; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 570px;">
								<tr>
									<td class="content-cell" align="center" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; padding: 35px;">
										<p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; line-height: 1.5em; margin-top: 0; color: #aeaeae; font-size: 12px; text-align: center;">© 2021 All Rights reserved. Thai Yamazaki Co.,Ltd.
											<!-- <br>1, 22nd Fl. Fortune Town Building, Ratchadapisek Rd., Dindaeng, Dindaeng, Bangkok 10400 --></p>
										</td>
									</tr>
								</table>
							</td>
						</tr>

					</table>
				</td>
			</tr>
		</table>
	</body>
	</html>

