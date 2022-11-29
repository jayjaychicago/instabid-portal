<?php
include "instabid.php";
$userId = $_SESSION["userId"]; // Instabid needs userIds but does not maintain users. 
authorize_user_to_bid($userId); // This tells instabid that you're ok for this user to bid. Typically done in the login processing form
?>
<HEAD>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/manage/assets/instabid.js"></script>
<script type="text/javascript" src="/manage/assets/instabid_realtime.js"></script>
<script type="text/javascript" src="/manage/assets/instabid-ui.js"></script>
<SCRIPT>
jQuery(document).ready(function ($) {


var exchange = "TEST"; // You can find your exchange number in the My exchanges tab
var product = "test"; // You can find your product name in the My products tab

placeSimpleBid(exchange, product, $("#simpleBidDiv")); // This places the bid input tool inside the simpleBidDiv div
bidToTable(exchange, product, $("#simpleBidsTableDiv"), 'class="table table-hover gradienttable" data-sort-name="Product Name" data-sort-order="desc"'); // This places the list of all existing bids in the simpleBidsTableDiv div. Note some extra bootstrap formatting

});
</SCRIPT>
</HEAD>
<BODY>
	<div id="simpleBidDiv">
	<div id="simpleBidsTableDiv">
</BODY>
