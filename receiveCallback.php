<?php 

/*
1. pull callback parameters
2. verify authenticity of the payment
3. process the order (what was paid for)
4. complete the transaction by confirming or cancelling payment whether it’s success or failure	
*/

    include_once './classes/DBSlydeBridge.class.php';
    include_once './classes/slydepay/Integrator.class.php';
        
    $settings= parse_ini_file("config/local.ini");
    $bridge = new DBSlydeLayer($settings);
    $slydepayIntegrator = new SlydepayConnector($settings);
    $statusCode = filter_input(INPUT_GET, "status", FILTER_SANITIZE_STRING);
    $transactionId = filter_input(INPUT_GET, "transac_id", FILTER_SANITIZE_STRING);
    $orderId = filter_input(INPUT_GET, "cust_ref", FILTER_SANITIZE_STRING);
    $paymentToken = filter_input(INPUT_GET, "pay_token", FILTER_SANITIZE_STRING);
	$error = "";
    
    if(null == $statusCode || null == $orderId || null == $paymentToken){
		$error = "Not good, details are missing or someone is messing with you";
		die();
    }
    
    $paymentStatus = parseTransactionStatusCode($statusCode);
    
    if(null == $transactionId || strlen($transactionId) == 0) {
        $bridge->updateOrder($orderId, "", "FAILED");
        $error = ("Empty or Null Transaction Id");
		die();
    }
    if($bridge->ValidateTransaction($paymentToken) != $orderId){
        $error = ("There is no transaction corresponding to the received payment token. Please contact slydepay support");
		die();
    }
	
   $OrderResult = $slydepayIntegrator->VerifyMobilePayment($orderId);
    if($OrderResult->verifyMobilePaymentResult->success){
        $bridge->updateOrder($orderId, $transactionId, $paymentStatus);
        $slydepayIntegrator->ConfirmTransaction($paymentToken, $transactionId);
		//do another process like initiate shipping and email and sms notification
        $error = "Order has been placed";
    } else {
        $error = "Something seems to be wrong with your order, Kindly start afresh";
        $slydepayIntegrator->CancelTransaction($paymentToken, $transactionId);
    }
    
    
    function parseTransactionStatusCode($statusCode) {
		$status = "";
        switch ($statusCode){
            case "0":
                $status = "success";
                break;
            case "-2":
                $status = "cancelled";
                break;
            case "-1":
                $status = "error";
                break;
            default:
            	$status = "unknown";
        }
        return $status;
	}
        
    
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Carte</title>

		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css" />

		<!-- page specific plugin styles -->

		<!-- text fonts -->
		<link rel="stylesheet" href="assets/css/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->
		<link rel="stylesheet" href="assets/css/ace-skins.min.css" />
		<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="assets/js/ace-extra.min.js"></script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
	</head>

	<body class="no-skin">
		
		<div class="main-container ace-save-state" id="main-container">
			<div class="main-content">
				<div class="main-content-inner">
					<div class="page-content">
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<div class="space-6"></div>
								<div class="row">
									<div class="col-sm-10 col-sm-offset-1">
										<div class="widget-box transparent">
											<div class="widget-header widget-header-large">
												<h3 class="widget-title grey lighter">
													<i class="ace-icon fa fa-leaf green"></i>
													Transaction Details
												</h3>

												<div class="widget-toolbar no-border invoice-info">
													<span class="invoice-info-label">Invoice:</span>
													<span class="red">#121212</span>

													<br />
													<span class="invoice-info-label">Date:</span>
													<span class="blue">1/04/2017</span>
												</div>

												<div class="widget-toolbar hidden-480">
													<a href="#">
														<i class="ace-icon fa fa-print"></i>
													</a>
												</div>
											</div>

											<div class="widget-body">
												<div class="widget-main padding-24">
													<div class="row">
														<div class="col-sm-offset-3 col-sm-6">
															<div class="row">
																<div class="col-xs-11 label label-lg label-info arrowed-in arrowed-right">
																	<b>Company Info</b>
																</div>
															</div>

															<div>
																<ul class="list-unstyled spaced">
																	<li>
																		<i class="ace-icon fa fa-caret-right blue"></i>Street, City
																	</li>

																	<li>
																		<i class="ace-icon fa fa-caret-right blue"></i>Zip Code
																	</li>

																	<li>
																		<i class="ace-icon fa fa-caret-right blue"></i>State, Country
																	</li>

																	<li>
																		<i class="ace-icon fa fa-caret-right blue"></i>
Phone:
																		<b class="red">111-111-111</b>
																	</li>

																	<li class="divider"></li>

																	<li>
																		<i class="ace-icon fa fa-caret-right blue"></i>
																		Paymant Info
																	</li>
																</ul>
															</div>
														</div><!-- /.col -->

												</div><!-- /.row -->

													<div class="space"></div>

													<div>
														<table class="table table-striped table-bordered">
															<thead>
																<tr>
																	<th class="center">#</th>
																	<th>Product</th>
																	<th class="hidden-480">Discount</th>
																	<th>Total</th>
																</tr>
															</thead>

															<tbody>
																<tr>
																	<td class="center">1</td>

																	<td>
																		<a href="#">Rice</a>
																	</td>
																	<td class="hidden-480"> --- </td>
																	<td>4 Cedis</td>
																</tr>

																<tr>
																	<td class="center">2</td>

																	<td>
																		<a href="#">Salad</a>
																	</td>
																	<td class="hidden-480"> ...</td>
																	<td>1 Cedi</td>
																</tr>

																<tr>
																	<td class="center">3</td>
																	<td>Fish</td>
																	<td class="hidden-480"> -- </td>
																	<td>2 Cedis</td>
																</tr>
															</tbody>
														</table>
													</div>

													<div class="hr hr8 hr-double hr-dotted"></div>

													<div class="row">
														<div class="col-sm-5 pull-right">
															<h4 class="pull-right">
																Total amount :
																<span class="red">7 GH Cedis</span>
															</h4>
														</div>
														<div class="col-sm-7 pull-left"> Extra Information </div>
													</div>

													<div class="space-6"></div>
													<div class="well">
														<?=$error?>
													</div>
													<div class="well">
														Thank you for using Carte Platform .
				We believe you will be satisfied with our services.
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>

								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="assets/js/jquery-2.1.4.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="assets/js/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->

		<!-- ace scripts -->
		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/ace.min.js"></script>

		<!-- inline scripts related to this page -->
	</body>
</html>
