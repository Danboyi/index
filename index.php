 <?php
 
function welcome(){
 
   if(date("H") < 12){
 
     return "Good Morning";
 
   }elseif(date("H") > 11 && date("H") < 18){
 
     return "Good Afternoon";
 
   }elseif(date("H") > 17){
 
     return "Good Evening";
 
   }
 
}  
?> <?php
// Start the Session
header("X-Robots-Tag: noindex, nofollow", true);
session_start();

require 'account/include/dbconfig.php';
require_once 'account/include/class.user.php';

$reg_user = new USER();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acc_no = $_POST['acc_no'];
    $upass = $_POST['upass'];

    // Query the database to check if account number and password match
    $query = "SELECT * FROM account WHERE acc_no = '$acc_no' AND upass = '$upass'";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $count = mysqli_num_rows($result);

    // Get the account status from the database
    $stmt = $reg_user->runQuery("SELECT * FROM account WHERE acc_no = '$acc_no'");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $status = $row['status'];

    // Handle different status cases
    if ($count == 0) {
        $msg = "<div class='alert alert-danger'>
                    <button class='close' data-dismiss='alert'>&times;</button>
                      Invalid Account No or Password!
                </div>";
    } elseif ($status == 'DISABLED') {
        $msg = "<div class='alert alert-inverse'>
                    <button class='close' data-dismiss='alert'>&times;</button>
                      <strong>Sorry! Your Account Has Been Disabled For Violation of Our Terms!</strong>
                </div>";
    } elseif ($status == 'CLOSED') {
        $msg = "<div class='alert alert-inverse'>
                    <button class='close' data-dismiss='alert'>&times;</button>
                      <strong>Sorry! This Account is Inactive, <br>kindly Contact Customer Care.</strong>
                </div>";
    } elseif ($status == 'SUSPEND') {
        $msg = "<div class='alert alert-inverse'>
                    <button class='close' data-dismiss='alert'>&times;</button>
                      <strong>Sorry! This Account is Suspended Contact Customercare!</strong>
                </div>";
    } else {
        // Create session for the user and redirect to dashboard/summary.php
        $_SESSION['acc_no'] = $acc_no;
        // Redirect user to dashboard/summary.php
        // header("Location: dashboard/summary.php");
    }
}
//3.1.4 if the user is logged in Greets the user with message
if (isset($_SESSION['acc_no'])) {
    $code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
    $sender = "Frontwave Credit Union"; /* sender id */
    $message = "Please enter this code to continue proceed
				$code";


    $message = "
				<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
  <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
  <title>[SUBJECT]</title>
  <style type='text/css'>
  body {
   padding-top: 0 !important;
   padding-bottom: 0 !important;
   padding-top: 0 !important;
   padding-bottom: 0 !important;
   margin:0 !important;
   width: 100% !important;
   -webkit-text-size-adjust: 100% !important;
   -ms-text-size-adjust: 100% !important;
   -webkit-font-smoothing: antialiased !important;
 }
 .tableContent img {
   border: 0 !important;
   display: block !important;
   outline: none !important;
 }
 a{
  color:#382F2E;
}

p, h1{
  color:#382F2E;
  margin:0;
}

div,p,ul,h1{
  margin:0;
}
p{
font-size:13px;
color:#99A1A6;
line-height:19px;
}
h2,h1{
color:#444444;
font-weight:normal;
font-size: 22px;
margin:0;
}
a.link2{
padding:15px;
font-size:13px;
text-decoration:none;
background:#2D94DF;
color:#ffffff;
border-radius:6px;
-moz-border-radius:6px;
-webkit-border-radius:6px;
}
.bgBody{
background: #f6f6f6;
}
.bgItem{
background: #2C94E0;
}

@media only screen and (max-width:480px)
		
{
		
table[class='MainContainer'], td[class='cell'] 
	{
		width: 100% !important;
		height:auto !important; 
	}
td[class='specbundle'] 
	{
		width: 100% !important;
		float:left !important;
		font-size:13px !important;
		line-height:17px !important;
		display:block !important;
		
	}
	td[class='specbundle1'] 
	{
		width: 100% !important;
		float:left !important;
		font-size:13px !important;
		line-height:17px !important;
		display:block !important;
		padding-bottom:20px !important;
		
	}	
td[class='specbundle2'] 
	{
		width:90% !important;
		float:left !important;
		font-size:14px !important;
		line-height:18px !important;
		display:block !important;
		padding-left:5% !important;
		padding-right:5% !important;
	}
	td[class='specbundle3'] 
	{
		width:90% !important;
		float:left !important;
		font-size:14px !important;
		line-height:18px !important;
		display:block !important;
		padding-left:5% !important;
		padding-right:5% !important;
		padding-bottom:20px !important;
	}
	td[class='specbundle4'] 
	{
		width: 100% !important;
		float:left !important;
		font-size:13px !important;
		line-height:17px !important;
		display:block !important;
		padding-bottom:20px !important;
		text-align:center !important;
		
	}
		
td[class='spechide'] 
	{
		display:none !important;
	}
	    img[class='banner'] 
	{
	          width: 100% !important;
	          height: auto !important;
	}
		td[class='left_pad'] 
	{
			padding-left:15px !important;
			padding-right:15px !important;
	}
		 
}
	
@media only screen and (max-width:540px) 

{
		
table[class='MainContainer'], td[class='cell'] 
	{
		width: 100% !important;
		height:auto !important; 
	}
td[class='specbundle'] 
	{
		width: 100% !important;
		float:left !important;
		font-size:13px !important;
		line-height:17px !important;
		display:block !important;
		
	}
	td[class='specbundle1'] 
	{
		width: 100% !important;
		float:left !important;
		font-size:13px !important;
		line-height:17px !important;
		display:block !important;
		padding-bottom:20px !important;
		
	}		
td[class='specbundle2'] 
	{
		width:90% !important;
		float:left !important;
		font-size:14px !important;
		line-height:18px !important;
		display:block !important;
		padding-left:5% !important;
		padding-right:5% !important;
	}
	td[class='specbundle3'] 
	{
		width:90% !important;
		float:left !important;
		font-size:14px !important;
		line-height:18px !important;
		display:block !important;
		padding-left:5% !important;
		padding-right:5% !important;
		padding-bottom:20px !important;
	}
	td[class='specbundle4'] 
	{
		width: 100% !important;
		float:left !important;
		font-size:13px !important;
		line-height:17px !important;
		display:block !important;
		padding-bottom:20px !important;
		text-align:center !important;
		
	}
		
td[class='spechide'] 
	{
		display:none !important;
	}
	    img[class='banner'] 
	{
	          width: 100% !important;
	          height: auto !important;
	}
		td[class='left_pad'] 
	{
			padding-left:15px !important;
			padding-right:15px !important;
	}
		
	.font{
		font-size:15px !important;
		line-height:19px !important;
		
		}
}

</style>

<script type='colorScheme' class='swatch active'>
  {
    'name':'Default',
    'bgBody':'f6f6f6',
    'link':'ffffff',
    'color':'99A1A6',
    'bgItem':'2C94E0',
    'title':'444444'
  }
</script>

</head>
<body paddingwidth='0' paddingheight='0' bgcolor='#d1d3d4'  style=' margin-left:5px; margin-right:5px; margin-bottom:0px; margin-top:0px;padding-top: 0; padding-bottom: 0; background-repeat: repeat; width: 100% !important; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased;' offset='0' toppadding='0' leftpadding='0'>
  <table width='100%' border='0' cellspacing='0' cellpadding='0' class='tableContent bgBody' align='center'  style='font-family:Helvetica, Arial,serif;'>
  
    <!-- =============================== Header ====================================== -->

  <tr>
    <td class='movableContentContainer' >
    	<div class='movableContent' style='border: 0px; padding-top: 0px; position: relative;'>
        	<table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' valign='top'>
                   <tr><td height='25'  colspan='3'></td></tr>
         <tr>
                      <td valign='top'  colspan='3'>
                        <table width='600' border='0' bgcolor='transparent' cellspacing='0' cellpadding='0' align='center' valign='top' class='MainContainer'>
                          <tr>
                            <td align='left' valign='middle' width='100%'>
                              <div class='contentEditableContainer contentImageEditable'>
                                <div class='contentEditable' >
                                  <center><img src='$bank_domain/account/dashboard/icon/email.png' alt='' data-default='placeholder'></center>
								  <b style='font-size:1.5em; color:#fff;'></b>
                                </div>
                              </div>
                            </td>

                            
                          </tr>
                        </table>
                      </td>
                    </tr>
                </table>
        </div>
        <div class='movableContent' style='border: 0px; padding-top: 0px; position: relative;'>
        	<table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' valign='top'>
                        <tr><td height='2'  ></td></tr>

                        <tr>
                          <td height='200'  bgcolor='#fdfefe'>
                            <table align='center' border='0' cellspacing='0' cellpadding='0' class='MainContainer'>
  <tr>
    <td></td>
  </tr>
  

                                    <tr>
                                      <td></td>
                                      <td valign='top'>
                                        <table width='300' border='0' cellspacing='0' cellpadding='0' align='center' valign='top'>
                                          <tr>
                                            <td valign='top'>
                                              <div class='contentEditableContainer contentTextEditable'>
                                                <div class='contentEditable' >
                                                  <h1 style='font-size:20px;font-weight:normal;color:blue;line-height:19px;'>Dear $fname, </h1>
                                                </div>
                                              </div>
                                            </td>
                                          </tr>
                                          <tr><td height='18'></td></tr>
                                          <tr>
                                            <td valign='top'>
                                              <div class='contentEditableContainer contentTextEditable'>
                                                <div class='contentEditable' >
                                                  <p style='font-size:13px;color:blue;line-height:19px;'>Please use the One Time Password OTP $code to complete your Login Process <br> 
                                                  </p>
                                                </div>
                                              </div>
                                            </td>
                                          </tr>
                                          
                                          <tr><td height='1'></td></tr>
                                        </table>
                                      </td>
                                      <td></td>
                                    </tr>
                                  </table>
                                </td>
  </tr>
</table>
</td>
  </tr>

</table>

                          </td>
                        </tr>

                        <tr><td height='0' ></td></tr>
                </table>
       
        
        
        
        <div class='movableContent' style='border: 0px; padding-top: 0px; position: relative;'>
        	<table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' valign='top'>
                  <tr>
                    <td>
                      <table width='600' border='0' cellspacing='0' cellpadding='0' align='center' valign='top' class='MainContainer'>
                        <tr>
                          <td>
                            <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' valign='top'>

                              <tr>
                                <td>
                                  
                                </td>
                              </tr>
                              
                              <tr>
                                <td valign='top' align='center'>
                                  <div class='contentEditableContainer contentTextEditable'>
                                    <div class='contentEditable' >
                                      <p style=' font-weight:bold;font-size:13px;line-height: 30px;'>CB Online Banking</p>
                                    </div>
    <br>                           <div class='contentEditableContainer contentTextEditable'>
                                    <div class='contentEditable' >
                                      <p style='#F00; font-size:13px;line-height: 15px;'>This message is sent to this email to $fname <br /> <br /> <center><b>How do I know this is not a fake email?</b></center> <br />

An email really coming from us will address you by your registered first and last name or your business name. It will not ask you for sensitive information like your password, bank account or credit card details.<br /><br />
                                      </p>
                                      <p style='#F00; font-size:13px;line-height: 15px;'>Remember not to click any links in suspicious looking emails. </p>
                                    </div>
                                  </div>                               </div>
                                  <div class='contentEditableContainer contentTextEditable'>
                                    <div class='contentEditable' >
                                      <p style='color:#A8B0B6; font-size:13px;line-height: 15px;'>&nbsp;</p>
                                    </div>
                                  </div>
                                  <div class='contentEditableContainer contentTextEditable'>
                                  </div>
                                  <div class='contentEditableContainer contentTextEditable'>
                                    
                                  </div>
                                </td>
                              </tr>

                              <tr><td height='28'>&nbsp;</td></tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
          </table>
        </div>
    </td>
  </tr>
</table>


</body>
  </html>


";



    $acc_no = $_SESSION['acc_no'];

    $queri = " UPDATE account SET tmp_otp = '$code' WHERE acc_no ='$acc_no'";
    $resulti = mysqli_query($connection, $queri) or die(mysqli_error($connection));

    $subject = "Login Verification";
    $stmt = $reg_user->runQuery("SELECT * FROM account WHERE acc_no = '$acc_no'");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (isset($_SESSION['acc_no']) && $row['phone_verify'] == 1) {
        header('Location: account/dashboard/pin_auth.php');
        exit();
    } else {
        $reg_user->send_mail($row['email'], $message, $subject);
        $phone = preg_replace('/[^0-9]/', '', $row['phone']);
        $mobile_msg = "Dear " . $row['fname'] . ", Please use the One Time Passcode (OTP): " . $code . " to complete your login process";
        $reg_user->otp($phone,$mobile_msg);
        header('Location: dashboard/otp.php');
    }
} else {
    
}
//3.2 When the user visits the page first time, simple login form will be displayed.
?>

<!doctype html>
<html lang="en">


<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <title>Frontwave Credit Union Bank</title>
     <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">      <title></title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />

	<!-- Favicon icon -->    
	<link rel="stylesheet" href="site.min.css" type="text/css">
	<link rel="shortcut icon" type="image/png" href="images/favicon.png"/>    		
	<!-- Bootstrap -->    
	<link href="css/bootstrap.min.css" rel="stylesheet">	
	<!-- Fontawsome -->    
	<link href="css/font-awesome.min.css" rel="stylesheet">    
	<!-- Animate CSS-->    
	<link href="css/animate.css" rel="stylesheet">    
	<!-- menu CSS-->    
	<link href="css/bootstrap-4-navbar.css" rel="stylesheet">		
	<!-- Portfolio Gallery -->    
	<link href="css/filterizer.css" rel="stylesheet">	
	<!-- Lightbox Gallery -->    
	<link href="inc/lightbox/css/jquery.fancybox.css" rel="stylesheet">	
	<!-- OWL Carousel -->	
	<link rel="stylesheet" href="css/owl.carousel.min.css">	
	<link rel="stylesheet" href="css/owl.theme.default.min.css">    
	<!-- Preloader CSS-->    
	<link href="css/fakeLoader.css" rel="stylesheet">	
	<!-- Main CSS -->    
	<link href="style.css" rel="stylesheet">   
	<!-- Default CSS Color -->     
	<link href="color/default.css" rel="stylesheet">     
	<!-- Color CSS -->     
	<link rel="stylesheet" href="color/color-switcher.css">    
	<!-- Default CSS Color -->     
	<link href="color/default.css" rel="stylesheet">     
	<!-- Color CSS -->     
	<link rel="stylesheet" href="color/color-switcher.css">	
	<!-- Responsive CSS -->    
	<link href="css/responsive.css" rel="stylesheet">    
	<link href="css/customcss.css" rel="stylesheet">    
	</head>
	<!--header open in header-->


  <body>
  <style>
      .navbar-brand h2{
          font-size:35px;
          margin-top:2px;
      }
  </style>
   <!-- Preloader -->
    <div id="fakeloader"></div>
	
	<div class="top-menu-1x">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
				<div class="top-menu-left">
						<p>Need help? Contact Us</p>
						<b><i class="fa fa-phone"></i> +1(731) 472-0065</b>
						<b><i class="fa fa-envelope"></i><a style="color:#fff;"  href="mailto:hello@frontwavcreditunion.com">hello@frontwavcreditunion.com</a></b>
					</div>			
				</div>				
				<div class="col-md-6">
				<div class="top-menu-right">
						<div class="footer-info-right">
								
						</div>					
					</div>	
					</div>
			</div>
		</div>
	</div>

	<div class="bussiness-main-menu-1x">	
		<div class="container">
			<div class="row">
				<div class="col-md-12">		
					<div class="business-main-menu">		
						<nav class="navbar navbar-expand-lg navbar-light bg-light btco-hover-menu">
						<a class="navbar-brand" href="index.php">
							<img style="max-width:125px;" src="logo1.png" class="d-inline-block align-top" alt="">		
							<!--<h2><span style="color:#EC4550;">I</span><span style="color:#0E3768;">BG</span></h2>-->
						</a>
					  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					  </button>

					  <div class="collapse navbar-collapse" id="navbarSupportedContent">
					  
						<ul class="navbar-nav ml-auto business-nav">
							<li class="nav-item dropdown">
									<a class="nav-link" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Banking Services <i class="fa fa-angle-down"></i><span style="display: block;font-size: 11px;">Accounts & services</span>
									</a>
									<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink2"  style="width: 100%;background-color: #fff;">
									
									<div class="container">
										<div class="business-services nav1">	
											<div class="row">				
												<div class="col-md-12 service-content">
													<div class="row">
														<div class="col-md-3">
															<div class="single-services">
																<div class="media">
																  <div class="media-body">
																	<a href="current-accounts.html" class="menuhead">Current Accounts</a>
																		<li><a class="dropdown-item" href="advance-accounts.html">Advance Account</a></li>
																		<li><a class="dropdown-item" href="bank-accounts.html">Bank Account</a></li>
																  </div>
																</div>	
															</div>	
														</div>
														<div class="col-md-3">
															<div class="single-services">
																<div class="media">
																  <div class="media-body">
																	<a href="saving-accounts.html" class="menuhead">Savings</a>
																		<li><a class="dropdown-item" href="isas-accounts.html">ISAs</a></li>
																		<li><a class="dropdown-item" href="online-bonus-saver.html">Online Bonus Saver</a></li>
																		<li><a class="dropdown-item" href="flexible-saver.html">Flexible Saver</a></li>
																  </div>
																</div>	
															</div>	
														</div>
														<div class="col-md-3">
															<div class="single-services">
																<div class="media">
																  <div class="media-body">
																	<a href="credit-cards.html" class="menuhead">Credit cards</a>
																		<li><a class="dropdown-item" href="32-month-balance-transfer.html">32 Month Transfer Credit Card</a></li>
																		<li><a class="dropdown-item" href="advance.html">Advance Credit Card</a></li>
																  </div>
																</div>	
															</div>	
														</div>
														<div class="col-md-3">
															<div class="single-services">
																<div class="media">
																  <div class="media-body">
																	<a href="contactandsupport.html" class="menuhead">Services</a>
																		<li><a class="dropdown-item" href="ways-to-bank.html">Ways to bank</a></li>
																		<li><a class="dropdown-item" href="phone-banking.html">Voice ID</a></li>
																		<li><a class="dropdown-item" href="contactandsupport.html">Contact & Support</a></li>
																  </div>
																</div>	
															</div>	
														</div>
													</div>
												</div>									
											</div>
										</div>
									</div>                                     
								</ul>
								</li>
							    <li class="nav-item dropdown">
									<a class="nav-link" href="#" id="navbarDropdownMenuLink3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Borrowing <i class="fa fa-angle-down"></i><span style="display: block;font-size: 11px;">Loans & mortgages</span>
									</a>
									<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink2"  style="width: 100%;background-color: #fff;">
									
									<div class="container">
										<div class="business-services nav2">	
											<div class="row">				
												<div class="col-md-12 service-content">
													<div class="row">
														<div class="col-md-3">
															<div class="single-services">
																<div class="media">
																  <div class="media-body">
																	<a href="loans.html" class="menuhead">Loans</a>
																		<li><a class="dropdown-item" href="personal-loans.html">Personal Loan</a></li>
																		<li><a class="dropdown-item" href="flexible.html">Flexiloan</a></li>
																  </div>
																</div>	
															</div>	
														</div>
														<div class="col-md-3">
															<div class="single-services">
																<div class="media">
																  <div class="media-body">
																	<a href="mortgages.html" class="menuhead">Mortgages</a>
																		<li><a class="dropdown-item" href="first-time-buyers.html">First time buyer</a></li>
																		<li><a class="dropdown-item" href="remortgage.html">Remortgage</a></li>
																  </div>
																</div>	
															</div>	
														</div>
														<div class="col-md-3">
															<div class="single-services">
																<div class="media">
																  <div class="media-body">
																	<a href="credit-cards.html" class="menuhead">Credit cards</a>
																	<li><a class="dropdown-item" href="32-month-balance-transfer.html">32 Month Transfer Credit Card</a></li>
																	<li><a class="dropdown-item" href="advance.html">Advance Credit Card</a></li>
																  </div>
																</div>	
															</div>	
														</div>
														<div class="col-md-3">
															<div class="single-services">
																<div class="media">
																  <div class="media-body">
																	<a href="contactandsupport.html" class="menuhead">Services</a>
																	<li><a class="dropdown-item" href="contactandsupport.html">Help & Support</a></li>
																	<li><a class="dropdown-item" href="money-worries.html">Money Worries</a></li>
																  </div>
																</div>	
															</div>	
														</div>		
													</div>
												</div>									
											</div>
										</div>
									</div>                                     
								</ul>
							  </li>	

							  <li class="nav-item dropdown">
									<a class="nav-link" href="#" id="navbarDropdownMenuLink3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Investing <i class="fa fa-angle-down"></i><span style="display: block;font-size: 11px;">Products & analysis</span>
									</a>
									<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink2"  style="width: 100%;background-color: #fff;">
									
									<div class="container">
										<div class="business-services nav3">	
											<div class="row">				
												<div class="col-md-12 service-content">
													<div class="row">
														<div class="col-md-3">
															<div class="single-services">
																<div class="media">
																  <div class="media-body">
																	<a href="investing.html" class="menuhead">Investments</a>
																		<li><a class="dropdown-item" href="investment-funds.html">Investment funds</a></li>
																		<li><a class="dropdown-item" href="world-selection-isa.html">World Selection ISA</a></li>
																  </div>
																</div>	
															</div>	
														</div>
														
														<div class="col-md-3">
															<div class="single-services">
																<div class="media">
																  <div class="media-body">
																	<a href="news.html" class="menuhead">Financial news & analysis</a>
																  </div>
																</div>	
															</div>
															<div class="single-services">
																<div class="media">
																  <div class="media-body">
																	<a href="wealth-insights.html" class="menuhead">Wealth Insights </a>
																  </div>
																</div>	
															</div>	
														</div>
														<div class="col-md-3">
															<div class="single-services">
																<div class="media">
																  <div class="media-body">
																	<a href="investment-funds-online.html" class="menuhead">Global Investment Centre</a>
																		<li><a class="dropdown-item" href="investment-funds-online.html">Find out more</a></li>
																	</div>
																</div>
															</div>
														</div>	
														<div class="col-md-3">
															<div class="single-services">
																<div class="media">
																  <div class="media-body">
																	<a href="contactandsupport.html" class="menuhead">Customer support</a>
																		<li><a class="dropdown-item" href="gsa.html">Log on to Global Investment<br>Centre</a></li>
																		<li><a class="dropdown-item" href="gsa.html">Log on to Sharedealing</a></li>
																  </div>
																</div>	
															</div>	
														</div>			
													</div>
												</div>									
											</div>
										</div>
									</div>                                     
								</ul>
							  </li>	

							  <li class="nav-item dropdown">
									<a class="nav-link" href="#" id="navbarDropdownMenuLink3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Insurance <i class="fa fa-angle-down"></i><span style="display: block;font-size: 11px;">Property & family</span>
									</a>
									<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink2"  style="width: 100%;background-color: #fff;">
									
									<div class="container">
										<div class="business-services nav4">	
											<div class="row">				
												<div class="col-md-12 service-content">
													<div class="row">
														<div class="col-md-3">
															<div class="single-services">
																<div class="media">
																  <div class="media-body">
																	<a href="insurance.html" class="menuhead">Insurance</a>
																		<li><a class="dropdown-item" href="home-insurance.html">Home Insurance</a></li>
																		<li><a class="dropdown-item" href="travel-insurance.html">Travel Insurance</a></li>
																  </div>
																</div>	
															</div>	
														</div>
														
														<div class="col-md-3">
															<div class="single-services">
																<div class="media">
																  <div class="media-body">
																	<a href="life-insurance.html" class="menuhead">Life Insurance</a>
																	<li><a class="dropdown-item" href="life-cover.html">Life Cover</a></li>
																	<li><a class="dropdown-item" href="critical-illness-cover.html">Critical Illness Cover</a></li>
																  </div>
																</div>	
															</div>
														</div>
														<div class="col-md-3">
															<div class="single-services">
																<div class="media">
																  <div class="media-body">
																	<a href="insurance.html" class="menuhead">Insurance Claims</a>
																		<li><a class="dropdown-item" href="home-insurance-claims.html">Home Insurance Claims</a></li>
																		<li><a class="dropdown-item" href="travel-insurance.html">Travel Insurance Claims</a></li>
																	</div>
																</div>
															</div>
														</div>	
														<div class="col-md-3">
															<div class="single-services">
																<div class="media">
																  <div class="media-body">
																	<a href="Ridge-accounts.html" class="menuhead">Frontwave Credit Union Customers</a>
																		<li><a class="dropdown-item" href="Ridge-travel.html">Travel Insurance Claims</a></li>
																		<li><a class="dropdown-item" href="Ridge-car.html">Car Insurance Claims</a></li>
																  </div>
																</div>	
															</div>	
														</div>			
													</div>
												</div>									
											</div>
										</div>
									</div>                                     
								</ul>
							  </li>
								
								<li class="nav-item dropdown">
									<a class="nav-link" href="#" id="navbarDropdownMenuLink3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Life events <i class="fa fa-angle-down"></i><span style="display: block;font-size: 11px;">Help & support</span>
									</a>
									<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink2"  style="width: 100%;background-color: #fff;">
									
									<div class="container">
										<div class="business-services nav5">	
											<div class="row">				
												<div class="col-md-12 service-content">
													<div class="row">
														<div class="col-md-3">
															<div class="single-services">
																<div class="media">
																  <div class="media-body">
																	<a href="life-events.html" class="menuhead">Life events</a>
																		<li><a class="dropdown-item" href="dealing-with-bereavement.html">Bereavement support</a></li>
																		<li><a class="dropdown-item" href="dealing-with-separation.html">Separation support</a></li>
																  </div>
																</div>	
															</div>	
														</div>
														
														<div class="col-md-3">
															<div class="single-services">
																<div class="media">
																  <div class="media-body">
																	<a href="planningtools.html" class="menuhead">Planning tools</a>
																	<li><a class="dropdown-item" href="financial-health-check.html">Financial health check</a></li>
																	<li><a class="dropdown-item" href="planningtools.html">View All</a></li>
																  </div>
																</div>	
															</div>
														</div>
														<div class="col-md-3">
															<div class="single-services">
																<div class="media">
																  <div class="media-body">
																	<a href="protecting-what-matters.html" class="menuhead">Protecting what matters</a>
																		<li><a class="dropdown-item" href="protecting-what-matters.html">Learn more</a></li>
																	</div>
																</div>
															</div>
														</div>	
														<div class="col-md-3">
															<div class="single-services">
																<div class="media">
																  <div class="media-body">
																	<a href="contactandsupport.html" class="menuhead">Customer support</a>
																		<li><a class="dropdown-item" href="ways-we-can-help.html">Ways we can help</a></li>
																		<li><a class="dropdown-item" href="money-worries.html">Money Worries</a></li>
																  </div>
																</div>	
															</div>	
														</div>			
													</div>
												</div>									
											</div>
										</div>
									</div>                                     
								</ul>
							  </li>
							   
							 </ul>	
						  </div>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</div>	
	<!--NAVIGATION END-->	<!-- content start-->
	<style type="text/css">
    ##userpinid,##useridtextid {
    color: ##717171;
    font-size: 1em;
    line-height: 1.375em;
    background: none;
    border: none;
        border-bottom-color: currentcolor;
        border-bottom-style: none;
        border-bottom-width: medium;
    border-bottom-color: currentcolor;
    border-bottom-style: none;
    border-bottom-width: medium;
    border-bottom: 1px solid ##ccc;
    padding: .313em;
    margin: .188em 0;
}
</style>
<!--home content start-->
<div class="business-main-slider1">
		<div class="owl-carousel1 main-slider1">
			<div class="item1">			
				<div class="hvrbox">
					<img src="images/b1.jpg" alt="Mountains" class="hvrbox-layer_bottom">
					<div class="business-main-slider">
						<div class="banner-content">
							<div class="owl-carousel main-slider">
								<div class="item">	
									<div class="innerBannerContent row">
										<div class="col-sm-7">
											<h2>Discover our new 95% mortgages</h2>
											<p>We are making it easier for first time buyers to get on the property ladder. Available on property purUBSs.</p>
											<a href="##" class="bussiness-btn-larg">Find out more</a>
										</div>
										<div class="col-sm-5">
											<img src="images/visa.png" alt=""/>
										</div>
									</div>
								</div>
								<div class="item">	
									<div class="innerBannerContent row">
										<div class="col-sm-7">
											<h2>Investment Banking</h2>
											<p>Investment Banking provides comprehensive financial advisory, capital raising, financing and risk management services to corporations.</p>
											<a href="##" class="bussiness-btn-larg">Find out more</a>
										</div>
										<div class="col-sm-5">
											<img src="images/visa1.png" alt=""/>
										</div>
									</div>
								</div>
								<div class="item">	
									<div class="innerBannerContent row">
										<div class="col-sm-7">
											<h2>Global Finance</h2>
											<p>Our M&A team works in partnership with coverage bankers in providing solutions, using a highly analytical approach, providing unique insights.</p>
											<a href="##" class="bussiness-btn-larg">Find out more</a>
										</div>
										<div class="col-sm-5">
											<img src="images/visa2.png" alt=""/>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="loginbox">
						<div class="innerlogin" id="login-form">
							
							  <h3> Hi, <?php echo welcome();  ?>! <span class="pl-0 h2 pl-sm-2 text-muted d-inline-block"></span></h3>
								  <div id="login">
								   <?php
if (isset($_GET['inactive'])) {
    ?>
                        <div class='alert alert-info col-4'>
                            <button class='close' data-dismiss='alert'>&times;</button>
                                <strong>Sorry!</strong> This Account is not Activated Contact Customer Care Activate it. 
                        </div>
    <?php
}
?>
                    <?php if (isset($msg)) echo $msg; ?>
					
					<form class="form-horizontal" autocomplete="off"  method="post">
							    
								  <div class="form-group">
								    <div class="col-sm-10">
									<a style="color: black;"><b>ACCOUNT NUMBER</b></a>
									<span id="sprytextfield1" style="text-align:left;">
								      <input type="text" name="acc_no" class="form-control" placeholder="Enter <?php echo $site_initial; ?> Account Number." maxlength="20" required>
								  </span>
									</div>
								  </div>
								  <div class="form-group">
								  <a style="color: black;"><b>ACCOUNT PASSWORD</b></a>
								    <div class="col-sm-10"> 
									 <span id="sprypassword1" style="text-align:left;"> 
								      <input type="password" name="upass" class="form-control" placeholder="Enter <?php echo $site_initial; ?> Password" maxlength="20" required>
								     
								</span>
									</div>
								  </div>
								  <div class="form-group"> 
								    <div class="col-sm-offset-2 col-sm-10">
								      <div class="checkbox">
								        <label><input type="checkbox"> Remember me</label>
								        
								      </div>
								    </div>
								  </div>
								  <div class="form-group"> 
								    <div class="col-sm-offset-2 col-sm-10">
								      <button type="submit" name="login" class="btn btn-default loginbtn bussiness-btn-larg">Sign in</button>
								    </div>
								  </div>
								  <div class="form-group" style="margin-bottom: 0;line-height: 28px;"> 
								    
								    <center><div class="col-sm-offset-2 col-sm-10">
								    	<a href="account/dashboard/applicationform.php">Not enrolled? Sign up now.<i class="fa fa-angle-right" style="margin-left: 5px;" aria-hidden="true"></i></a>
								    	<br>
								    		
								    </div><center>
								  </div>
							 </form>
							 
						</div>
						
						
					</div>
				</div>			
            </div>

        </div>	
	</div>
	<div class="business-features-3x" style="margin-top: 60px;">
		<div class="colourful-features-content">				
			<div class="row">
				<div class="container">	
					<div class="col-sm-12 bankservice">
						<div class="business-title-middle" style="margin-bottom: 15px;">
							<h2>Choose what's right for you</h2>
							<span class="title-border-middle"></span>
						</div>
						<ul class="bxsliderwr">
							<li>
								<a href="##">
									<i class="icon-checking-small" aria-hidden="true"></i>
									<span>Invest</span>
								</a>
							</li>
							<li>
								<a href="##">
									<i class="icon-credit-score-medium" aria-hidden="true"></i>
									<span>Free credit score</span>
								</a>
							</li>
							<li>
								<a href="##">
									<i class="icon-savings-bank-medium" aria-hidden="true"></i>
									<span>Savings Accounts <br>& CDs</span>
								</a>
							</li>
							<li>
								<a href="##">
									<i class="icon-checking-medium" aria-hidden="true"></i>
									<span>Checking Accounts</span>
								</a>
							</li>
							<li>
								<a href="##">
									<i class="icon-credit-medium" aria-hidden="true"></i>
									<span>Find a credit card</span>
								</a>
							</li>
							<li>
								<a href="##">
									<i class="icon-mortgage2-medium" aria-hidden="true"></i>
									<span>Home Lending</span>
								</a>
							</li>
							<li>
								<a href="##">
									<i class="icon-Auto-loan-medium" aria-hidden="true"></i>
									<span>Car Buying & Loans</span>
								</a>
							</li>
							<li>
								<a href="##">
									<i class="icon-business-medium" aria-hidden="true"></i>
									<span>Frontwave Credit Union for Business</span>
								</a>
							</li>
							<li>
								<a href="##">
									<i class="icon-cpc-medium" aria-hidden="true"></i>
									<span>Frontwave Credit Union Private Client</span>
								</a>
							</li>
						</ul>
					</div>
				</div>					
				<div class="col-md-3 no-padding">				
					<div class="single-colorful-feature feature-color-1">
						<h2><a href="##">Bank Accounts<i class="fa fa-angle-right" aria-hidden="true"></i></a></h2>
						<p>Discover the benefits of a bank account from Frontwave Credit Union.</p>	
					</div>									
				</div>					
				<div class="col-md-3 no-padding">				
					<div class="single-colorful-feature feature-color-2">
						<h2><a href="##">Mortgages<i class="fa fa-angle-right" aria-hidden="true"></i></a></h2>
						<p>Find one that’s right for your needs and circumstances.</p>	
					</div>									
				</div>					
				<div class="col-md-3 no-padding">				
					<div class="single-colorful-feature feature-color-3">
						<h2><a href="##">Travel Money<i class="fa fa-angle-right" aria-hidden="true"></i></a></h2>
						<p>Check rates and order online now.</p>	
					</div>									
				</div>					
				<div class="col-md-3 no-padding">				
					<div class="single-colorful-feature feature-color-4">
						<h2><a href="##">Savings<i class="fa fa-angle-right" aria-hidden="true"></i></a></h2>
						<p>See how we could help your money work harder.</p>	
					</div>									
				</div>
				<div class="col-md-3 no-padding">				
					<div class="single-colorful-feature feature-color-3">
						<h2><a href="##">Insurance<i class="fa fa-angle-right" aria-hidden="true"></i></a></h2>
						<p>Protect your family and property.</p>	
					</div>									
				</div>
			</div>		
		</div>
	</div>

	<div class="business-wr">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<div class="single-bolg hover01">
						<figure><img src="images/blog-1.jpg" alt="slide 1" class=""></figure>
						<div class="blog-content">
							<a href="##">Up to £20,000 this tax year<i style="margin-left: 10px;" class="fa fa-angle-right" aria-hidden="true"></i></a>
							<span>Make the most of your 2019/<script>
function myFunction() {
  var d = new Date();
  var n = d.getFullYear();
  document.getElementById("demo").innerHTML = n;
}
</script> ISA allowance with an bank Selection Stocks and Shares ISA.</span>
						</div>
					</div>
				</div>			
				<div class="col-md-4">
					<div class="single-bolg hover01">
						<figure><img src="images/blog-2.jpg" alt="slide 1" class=""></figure>
						<div class="blog-content">
							<a href="##">Book an appointment<i style="margin-left: 10px;" class="fa fa-angle-right" aria-hidden="true"></i></a>
							<span>You can now book an appointment online. Existing customers may prefer to log on to Online Banking to make booking even simpler.</span>
							
						</div>
					</div>
				</div>			
				<div class="col-md-4">
					<div class="single-bolg hover01">
						<figure><img src="images/blog-3.jpg" alt="slide 1" class=""></figure>
						<div class="blog-content">
							<a href="##">Ring-fencing<i style="margin-left: 10px;" class="fa fa-angle-right" aria-hidden="true"></i></a>
							<span>We’re changing the way bank is structured in the EU.</span>
						</div>
					</div>
				</div>	
			</div>
		</div>
	</div>

	<div class="business-portfolio-1x" id="portfolio">
		<div class="container">
			<div class="row" style="padding: 30px 0;">
				<div class="col-md-3">
					<div class="single-bolg hover01">
						<figure><img src="images/blog-4.jpg" alt="slide 1" class=""></figure>
						<div class="blog-content">
							<a href="##">Insurance<i style="margin-left: 10px;" class="fa fa-angle-right" aria-hidden="true"></i></a>
							<span>Protect your family and property.</span>
						</div>
					</div>
				</div>	
				<div class="col-md-3">
					<div class="single-bolg hover01">
						<figure><img src="images/blog-5.jpg" alt="slide 1" class=""></figure>
						<div class="blog-content">
							<a href="##">Activate your card<i style="margin-left: 10px;" class="fa fa-angle-right" aria-hidden="true"></i></a>
							<span>There are several ways to easily activate your card. Choose the option that's best for you.</span>
						</div>
					</div>
				</div>	
				<div class="col-md-3">
					<div class="single-bolg hover01">
						<figure><img src="images/blog-6.jpg" alt="slide 1" class=""></figure>
						<div class="blog-content">
							<a href="##">Security centre<i style="margin-left: 10px;" class="fa fa-angle-right" aria-hidden="true"></i></a>
							<span>Handy tips designed to help you stay safe online.</span>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="single-bolg hover01">
						<figure><img src="images/blog-7.jpg" alt="slide 1" class=""></figure>
						<div class="blog-content">
							<a href="##">Helpful guides<i style="margin-left: 10px;" class="fa fa-angle-right" aria-hidden="true"></i></a>
							<span>A range of guides and articles from understanding APRs to saving tips.</span>
						</div>
					</div>
				</div>	
				<div class="col-sm-12" style="height: 1px;width: 100%;background-color:##EF454D;"></div>
				<div class="col-md-3">
					<div class="single-bolg hover01">
						<figure><img src="images/bl-840.jpg" alt="slide 1" class=""></figure>
						<div class="blog-content">
							<a href="##">Secure Key<i style="margin-left: 10px;" class="fa fa-angle-right" aria-hidden="true"></i></a>
							<span>Handy demos to help you activate, reset and use your Secure Key</span>
						</div>
					</div>
				</div>	
				<div class="col-md-3">
					<div class="single-bolg hover01">
						<figure><img src="images/blog-9.jpg" alt="slide 1" class=""></figure>
						<div class="blog-content">
							<a href="##">Voice ID<i style="margin-left: 10px;" class="fa fa-angle-right" aria-hidden="true"></i></a>
							<span>Make your voice your password for telephone banking</span>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="single-bolg hover01">
						<figure><img src="images/blog-8.jpg" alt="slide 1" class=""></figure>
						<div class="blog-content">
							<a href="##">Card support<i style="margin-left: 10px;" class="fa fa-angle-right" aria-hidden="true"></i></a>
							<span>Activate, lost or stolen, and general card support</span>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="single-bolg hover01">
						<figure><img src="images/couple-hiking-840.jpg" alt="slide 1" class=""></figure>
						<div class="blog-content">
							<a href="##">PPI<i style="margin-left: 10px;" class="fa fa-angle-right" aria-hidden="true"></i></a>
							<span>Payment Protection Insurance claim deadlines</span>
						</div>
					</div>
				</div>	
			</div>
		</div>
	</div>
      
    <div class="padding-top-large"></div>
	
	<div class="business-app-present-2x">	
		<div class="app-present-content-2">	
			<div class="container">
				<div class="row">

					<div class="col-md-12">
						<div class="business-title-middle">
							<h2>Your news and information</h2>
							<span class="title-border-middle"></span>
						</div>
					</div>
					
					<div class="col-md-5">				
						<div class="app-present-left-2">
							<img src="images/Question-mark.jpg" alt="Mountains" class="">
						</div>									
					</div>
					<div class="col-md-6" style="background-color: rgba(3, 61, 117, .1);">		
						<div class="app-present-right-2">
							<div class="single-app-present">
								<div class="media">
								  <div class="media-body">
									<h2>Account questions? Just ask me.</h2>
									<p>I’m just a few taps away — open your Frontwave Credit Union® mobile app and say hello.</p>
									<a class="bussiness-btn-larg" href="##">ask questions</a>
								  </div>
								</div>
							</div>		
						</div>		
					</div>
					
				</div>		
			</div>
		</div>
	</div> 
      
    <div class="padding-top-large"></div>
	
	<div class="business-cta-1x">	
		<div class="container">
			<div class="row">					
				<div class="col-md-12">
					<div class="cta-content">
						<h2>Open our most popular savings account</h2>
						<h3>Apply for a new Savings<sup>℠</sup> account in minutes.</h3>
						<a href="account/dashboard/applicationform.php" class="bussiness-btn-larg">apply Now</a>
					</div>									
				</div>		
			</div>		
		</div>
    </div> 

	<!-- End Client Map -->	
<!--home content end-->
	<div class="col-sm-12 connectus">
		<div class="container">
			<div class="inner-connect">
				<h5> Connect with us </h5>
				<a href="##">Listening to what you have to say about our services matters to us.</a>
			</div>
		</div>
	</div>
	<!-- Start Footer -->
	<footer class="bussiness-footer-1x">		
	    <div class="bussiness-footer-content ">
			<div class="container">
				<div class="row">
					<div class="col-md-3">	
						<h5> Help & support </h5>
						<a href="##">Got a question? We are here to help you </a>
					</div>
					<div class="col-md-3">
						<h5> Find a branch </h5>
						<a href="##">Find your nearest Frontwave Credit Union Banking location</a>
					</div>							
					<div class="col-md-3">	
						<h5> Our performance </h5>
						<a href="##">View our service dashboard to see how we're doing</a>		
					</div>

					<div class="col-md-3">	
						<h5> About Frontwave Credit Union </h5>								
						<a href="##">Frontwave Credit Union branches For financial issues or finance</a>							
					</div>					
<script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="7eff382f-9e71-4502-8544-7f60696a6ee6";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>
                    <div class="container">	
                        <div class="">
                            <div class="col-md-12 footer-info">
                                <div class="row">	
                                    <div class="col-md-6">	
                                        <div class="footer-info-left">	
                                            <!--<p><a href="##">Industri Banking Group</a></p>-->
                                            <img style="max-width:125px;" src="footlogo.png" class="d-inline-block align-top" alt="">
                                        </div>			
                                    </div>			
                                    <div class="col-md-6">
                                        <div class="footer-info-right">
                                            <ul>
                                                <li><a href="##"> <i class="fa fa-facebook"></i> </a></li>										
                                                <li><a href="##"> <i class="fa fa-twitter"></i> </a></li>											
                                                <li><a href="##"> <i class="fa fa-google"></i> </a></li>									
                                                <li><a href="##"> <i class="fa fa-linkedin"></i> </a></li>											
                                            </ul>					
                                        </div>					
                                    </div>					
                                </div>					
                            </div>					
                        </div>	  
					</div>
				</div>					
			</div>			
	    </div>		  
	</footer>	
	<!-- End Footer -->	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="1.12.4/jquery.min.js"></script>
 <script src="js/bootstrap.min.js"></script>

	<!-- Wow Script -->
	<script src="js/wow.min.js"></script>
	<!-- Counter Script -->
	<script src="js/waypoints.min.js"></script>
	<script src="js/jquery.counterup.min.js"></script>
	<!-- Masonry Portfolio Script -->
    <script src="js/jquery.filterizr.min.js"></script>
    <script src="js/filterizer-controls.js"></script>
    <!-- OWL Carousel js-->
	<script src="js/owl.carousel.min.js"></script>  
	<!-- Lightbox js -->
	<script src="inc/lightbox/js/jquery.fancybox.pack.js"></script>
	<script src="inc/lightbox/js/lightbox.js"></script>
	
	<!-- loader js-->
    <script src="js/fakeLoader.min.js"></script>
	<!-- Scroll bottom to top -->
	<script src="js/scrolltopcontrol.js"></script>
	<!-- menu -->
	<script src="js/bootstrap-4-navbar.js"></script>    
    <!-- Stiky menu -->

	<script src="js/jquery.magnific-popup.min.js"></script>  
    
    <!-- Color-switcher-active -->  
    <script src="js/color-switcher-active.js"></script>      
	<!-- Custom script -->
    <script src="js/custom.js"></script>
    <script src="js/jquery.bxslider.min.js"></script>
    
    <!-- for calucator---->
   

    <!--//---->
<!-- new script->

<!-- / script -->

<script src="ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="js/jquery.bxslider.min.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
		if( ($(window).width() > 769) ) {
			$('.bxsliderwr').bxSlider({
				minSlides: 5,
	  			maxSlides: 5,
	  			slideWidth: 230,
	  			pager:true,
	  			slideMargin: 50,
	  			moveSlides:1,
	  			auto: true,
	  			infiniteLoop: true,
	  			mode: 'horizontal',
			});
		}
		else if( ($(window).width() < 769) && ($(window).width() > 481) ) {
			$('.bxsliderwr').bxSlider({
				minSlides: 3,
	  			maxSlides: 3,
	  			slideWidth: 230,
	  			pager:true,
	  			slideMargin: 50,
	  			moveSlides:1,
	  			auto: true,
	  			infiniteLoop: true,
	  			mode: 'horizontal',
			});
		}
		else{
			$('.bxsliderwr').bxSlider({
				minSlides: 3,
	  			maxSlides: 3,
	  			slideWidth: 230,
	  			pager:false,
	  			slideMargin: 50,
	  			moveSlides:1,
	  			auto: true,
	  			infiniteLoop: true,
	  			mode: 'horizontal',
			});
		}
	}); 
</script>

	<script type="text/javascript">
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight){
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    } 
  });
}
</script>	

</body>

</html>     
