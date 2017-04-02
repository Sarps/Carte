<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Carte</title>
    <!--<link href='http://fonts.googleapis.com/css?family=Alegreya+Sans:300,400,700' rel='stylesheet' type='text/css'>   --> 
    <link href="assets/css/jquery.fullPage.css" rel="stylesheet"> 
	<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
	<link rel="stylesheet" href="assets/css/font-awesome.min.css" />
	<link rel="stylesheet" href="assets/css/fonts.googleapis.com.css" />
	<link rel="stylesheet" href="assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
	<link href="assets/css/main.css" rel="stylesheet">
	
	<script src="assets/js/ace-extra.min.js"></script>
	<script src="assets/js/jquery-2.1.4.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.fullPage.min.js"></script>
    <script src="assets/js/main.js"></script>
	
	<link rel="stylesheet" href="assets/css/jquery-ui.custom.min.css" />
		<link rel="stylesheet" href="assets/css/jquery.gritter.min.css" />
		<link rel="stylesheet" href="assets/css/select2.min.css" />
		<link rel="stylesheet" href="assets/css/bootstrap-datepicker3.min.css" />
		<link rel="stylesheet" href="assets/css/bootstrap-editable.min.css" />
	
	<script src="assets/js/ace-elements.min.js"></script>
	<script src="assets/js/ace.min.js"></script>
	
  </head>
  <body style="background: url(assets/images/page1-01.png) no-repeat center center fixed; background-size: cover; background-attachment: fixed;">
    <div id="fullpage">
    
	<section class="vertical-scrolling">
		<img src="assets/images/page1-01.png" class="fullscreen"/>
	</section>

	<section class="vertical-scrolling">
		<?php include 'registrar.php' ?>
	 </section>
     
	<section class="vertical-scrolling">
        <?php include 'profile.php' ?>
      </section>
     
	 <section class="vertical-scrolling">
        <div class="horizontal-scrolling">
			<?php include 'search.php' ?>
        </div>
        <div class="horizontal-scrolling">
			<?php include 'pricing.php'?>
        </div>
      </section>
	  <section class="vertical-scrolling">
        
      </section>
    </div>
 		
  </body>
</html>