  <?php
require_once("include/initialize.php");  
   
 ?>
     
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Vote | SSG Event Tallying</title>
    
    <!-- core CSS -->
    <link href="<?php echo web_root; ?>css/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo web_root; ?>css/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo web_root; ?>css/css/animate.min.css" rel="stylesheet">
    <link href="<?php echo web_root; ?>css/css/prettyPhoto.css" rel="stylesheet">
    <link href="<?php echo web_root; ?>css/css/main.css" rel="stylesheet">
    <link href="<?php echo web_root; ?>css/css/responsive.css" rel="stylesheet"> 
	<link href="<?php echo web_root; ?>font-awesome/css/font-awesome.min.css" rel="stylesheet"> 
	<link href="<?php echo web_root; ?>css/dataTables.bootstrap.css" rel="stylesheet"> 
	<!-- datetime picker CSS -->   
	<link rel="stylesheet" href="<?php echo web_root; ?>select2/select2.min.css"> 

 	<div class="col-lg-4 row" style="float-left"><img src="../img/sclogo.png"></div>

 	<style>
	fieldset 
		{
			text-align:center; width: 500px;
			background-color:white;
			height: auto;
			margin-left:30%;
			margin-top:85px;
			border-radius: 10px;
			box-shadow: 2px 4px 10px rgba(0,0,0,.6) 
		} 
	form INPUT 
		{
			padding: 10px;
		}
	body
		{
			background:url(images/bg/mainbg.png);
    }
	.button
		{
			width:110px; 
			height:50px;
			background: url("../images/login.png");
			background-size: 110px 50px;
			background-repeat: no-repeat;
			border:none;
			cursor:pointer;
		}
		p {
			color:#fff;
		}
		a:hover{
			color:#fff;
		}
		h3{
			color:#fff;
		}
</style>
</head><!--/head--> 

<body class="homepage" >
      <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12" id="content">
                     <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
								<div class="navbar navbar-inner block-header">
									<div class="container">
									<div id="" class="muted pull-right">
									 <a id="return" data-placement="left" title="Click to Return" href="index.php"><i class="icon-arrow-left"></i> Back</a>
									</div> 
									</div>
								</div>
                            <div class="block-content collapse in">
							<h3></i><i class="icon-group"></i>&nbsp;Team CAVB Developers</h3>
							<hr>
                                <div class="span3">
										<center>
										<img id="developers" src="developers/lloyd.png" class="img-circle">
										<hr>
										<p>Name: Lloyd G. Cordero</p>
										<p>Address: Binicuil Kabankalan City</p>
										<p>Email: itsmecorderolloyd@gmail.com</p>
										<p>Position: Project Leader/ Programmer</p>
										</center>
								</div>
								
                                <div class="span3">
										<center>
								        <img id="developers" src="developers/yugi.png" class="img-circle">
								        <hr>
										<p>Name: Joel P. Alibango Jr.</p>
										<p>Address: Brgy.5 Kabankalan City</p>
										<p>Email: erusevom.naix@yahoo.com</p>
										<p>Position: Programmer</p>
								        </center>
								</div>
								
                                <div class="span3">
										<center>
								        <img id="developers" src="developers/jan.png" class="img-circle">
								        <hr>
										<p>Name: John Rey a. Validor</p>
										<p>Address: Brgy. Galicia </p>
										<p>Email: Johnreyvalidor@yahoo.com</p>
										<p>Position: Documentalist</p>
								        </center>
								</div>
								
                                <div class="span3">
										<center>
								        <img id="developers" src="developers/cav.png" class="img-circle">
								        <hr>
										<p>Name: Glemar D. Balalilje</p>
										<p>Address: Brgy. Goce</p>
										<p>Email: glemarbalalilje@gmail.com</p>
										<p>Position: Designer</p>
								        </center>
								</div>
								
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
                </div>
            </div>
 </div>
 </body>
 </html>