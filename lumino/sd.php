<!DOCTYPE html>
<html>
<head>
	
	<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

echo "v1";
// Import the Composer Autoloader to make the SDK classes accessible:
require '../vendor/autoload.php';

// Load our environment variables from the .env file:
//(Dotenv\Dotenv::createImmutable(__DIR__))->load();

$env_array =getenv();

/*
echo "<h3>The list of environment variables with values are :</h3>";
//Print all environment variable names with values
foreach ($env_array as $key=>$value)
{
    echo "$key => $value <br />";
}
*/
// This is all setup in AWS ELB at: https://us-east-2.console.aws.amazon.com/elasticbeanstalk/home?region=us-east-2#/environment/configuration?applicationName=Instabid&environmentId=e-e2vtbrvebm
// In the "software" config portion of the ELB


$auth0 = new \Auth0\SDK\Auth0([
  'domain' => $_ENV['AUTH0_DOMAIN'],
  'clientId' => $_ENV['AUTH0_CLIENT_ID'],
  'clientSecret' => $_ENV['AUTH0_CLIENT_SECRET'],
  'cookieSecret' => $_ENV['AUTH0_COOKIE_SECRET'],
    'redirectUri' => 'https://portal.instabid.io/lumino/sd.php'
]);
	var_dump($auth0);
	die();
// 👆 We're continuing from the steps above. Append this to your index.php file.



// $auth0->exchange('https://portal.instabid.io/lumino/whoami.php');
// 👆 We're continuing from the "getting started" guide linked in "Prerequisites" above. Append this to the index.php file you created there.

	if ($auth0->getExchangeParameters()) {
    // If they're present, we should perform the code exchange.
    $auth0->exchange();
}

// Check if the user is logged in already
$session = $auth0->getCredentials();


if ($session === null) {
    // User is not logged in!
    // Redirect to the Universal Login Page for authentication.
    // header("Location: " . $auth0->login());
    echo "We made it here!";
    exit;
}

// 🎉 At this point we have an authenticated user session accessible from $session; your application logic can continue from here!
echo "Authenticated!";


?>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-6R68SV1E7N"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-6R68SV1E7N');
</script>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Instabid - Widgets</title>
<?php
session_start();
//ini_set('display_errors',1);
//error_reporting(E_ALL);

        include "instabid.php";
	$_SESSION["email"] = "julienpmjacquet@gmail.com";
	$_SESSION["userId"] = "julienpmjacquet@gmail.com";
	$_SESSION["instabid_userId"] = "julienpmjacquet@gmail.com";
	$userId = "julienpmjacquet@gmail.com";
    $email = "julienpmjacquet@gmail.com";
	#$email = $_SESSION["email"];
        #$userId = $_SESSION["email"];
	authorize_user_to_bid($userId);
 //       if ($email == "") { header( 'Location: /register.php' ) ; }
?>


<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="/manage/assets/instabid.js?version=<?php echo rand(1,1000000); ?>"></script>
<script type="text/javascript" src="/manage/assets/instabid_realtime.js?version=<?php echo rand(1,1000000); ?>"></script>
<script type="text/javascript" src="/manage/assets/instabid-ui.js?version=<?php echo rand(1,1000000); ?>"></script>
	<script src="/highchart/js/highstock.js"></script>
	<script src="/highchart/js/modules/exporting.js"></script>

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

<script>
jQuery(document).ready(function ($) {
        $("#liBids").addClass("active");
        $("#sub-item-1").addClass("in");
        $("#sd").css("font-weight","Bold");

placeBid("<?php echo $_GET["exchange"] ;?>", "<?php echo $_GET["product"] ;?>", $("#simpleBids"));
        depthToTable("<?php echo $_GET["exchange"] ;?>", "<?php echo $_GET["product"] ;?>", $("#simpleBidsTable"), 'class="table table-hover gradienttable" data-sort-name="Product Name" data-sort-order="desc"');
        orderToTable("<?php echo $_GET["exchange"] ;?>", "<?php echo $_GET["product"] ;?>", $("#orderTable"),'julienpmjacquet@gmail.com', 'class="table table-hover gradienttable" data-sort-name="Product Name" data-sort-order="desc"');
        fillToTable("<?php echo $_GET["exchange"] ;?>", "<?php echo $_GET["product"] ;?>", $("#fillTable"),'julienpmjacquet@gmail.com', 'class="table table-hover gradienttable" data-sort-name="Product Name" data-sort-order="desc"');

	placeGraph("<?php echo $_GET["exchange"] ;?>", "<?php echo $_GET["product"] ;?>",$("#graphTable"));
});
</script>
</head>

<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><span>Instabid</span>Admin</a>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION["email"]; ?> <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
							<li><a href="#"><span class="glyphicon glyphicon-cog"></span> Settings</a></li>
							<li><a href="/logoff_instabid.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div><!-- /.container-fluid -->
	</nav>

<?php include "sidebar.php" ;?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
				<li class="active">Bids / Answer a bid</li>
			</ol>
		</div>
		
		<div class="row">
			<div class="col-lg-12">
				<h3 class="page-header">Answer bids on <?php echo $_GET["product"] ; ?> product</h3> 
			</div>
		</div>
		<!--
		<div class="row">
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-blue panel-widget ">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<em class="glyphicon glyphicon-shopping-cart glyphicon-l"></em>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large">0</div>
							<div class="text-muted">Orders</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-orange panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<em class="glyphicon glyphicon-transfer glyphicon-l"></em>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large">0</div>
							<div class="text-muted">Fills</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-teal panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<em class="glyphicon glyphicon-tag glyphicon-l"></em>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large">1</div>
							<div class="text-muted">Products</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-red panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<em class="glyphicon glyphicon-home glyphicon-l"></em>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large">1</div>
							<div class="text-muted">Exchange</div>
						</div>
					</div>
				</div>
			</div>
		</div>-->
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Place a bid</div>
					<div class="panel-body">
					<div style="width:40%; float:right; margin-right:10%;" id="simpleBids"></div>
					<div style="width:10%;"></div>
					<div style="width:40%; float:left;" id="simpleBidsTable"></div>
						<!--
						<div class="canvas-wrapper">
							<canvas class="main-chart" id="line-chart" height="200" width="600"></canvas>
						</div>
						-->
					</div>
				</div>
			</div>
		</div><!--/.row-->
	<!--	
		<div class="row">
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<h4>New Orders</h4>
						<div class="easypiechart" id="easypiechart-blue" data-percent="92" ><span class="percent">92%</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<h4>Comments</h4>
						<div class="easypiechart" id="easypiechart-orange" data-percent="65" ><span class="percent">65%</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<h4>New Users</h4>
						<div class="easypiechart" id="easypiechart-teal" data-percent="56" ><span class="percent">56%</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<h4>Visitors</h4>
						<div class="easypiechart" id="easypiechart-red" data-percent="27" ><span class="percent">27%</span>
						</div>
					</div>
				</div>
			</div>
		</div> -->

<div class="row">
                        <div class="col-md-6">
                                <div class="panel panel-default">
                                        <div class="panel-heading" id="accordion"><span class="glyphicon glyphicon-book"></span> Bid History</div>
                                        <div class="panel-body">
                                                <div id="orderTable"></div>
                                        </div>
                                </div>
                        </div>
                        <div class="col-md-6">
                                <div class="panel panel-default">
                                        <div class="panel-heading" id="accordion2"><span class="glyphicon glyphicon-tag"></span> Completed Deals History</div>
                                        <div class="panel-body">
                                                <div id="fillTable"></div>
                                        </div>
                                </div>
                        </div>
</div>
<div class="row">
                        <div class="col-md-12">
                                <div class="panel panel-default">
                                        <div class="panel-heading" id="accordion2"><span class="glyphicon glyphicon-tag"></span> Price Graph</div>
                                        <div class="panel-body">
					<div id="graphTable"></div>
                                        </div>
                                </div>
			</div>
</div>
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script>
		$('#calendar').datepicker({
		});

		!function ($) {
		    $(document).on("click","ul.nav li.parent > a > span.icon", function(){          
		        $(this).find('em:first').toggleClass("glyphicon-minus");      
		    }); 
		    $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
	</script>	
</body>

</html>
