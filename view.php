<?php
require_once "spynot.php";

$packageName = $_GET['packageName'];
$searchString = $_GET['searchString'];

$appData = spynot_getApp($packageName);

#if ($appData != -1)
#	echo $appData->description;
#else
#	echo "App does not exist.";

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<title><? echo $appData->title; ?> | Spynot!</title>

		<!-- Bootstrap core CSS -->
		<link href="./bootstrap/css/bootstrap.css" rel="stylesheet">
		<style type="text/css">
			body { padding-top: 50px; padding-bottom: 20px;	}
		</style>

		<!-- Custom styles for this template -->
		<!--<link href="jumbotron.css" rel="stylesheet">-->

		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
		<![endif]-->
	</head>

	<body>

		<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index.php">Spynot!</a>
			</div>
			<?php
			if ($searchString)
			{ 
			?>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li><a href="search.php?searchString=<? echo $searchString;?>" onClick="if (document.referrer == 'http://localhost/spynot/search.php?searchString=<? echo $searchString;?>') { window.history.go(-1);console.log('true');return false;}">&larr; Back to results</a></li>
				</ul>
			</div>
			<?php
			}
			?>
			</div>
		</div>

		<!-- Main jumbotron for a primary marketing message or call to action -->
		<div class="jumbotron">
			<div class="container">
			<h1><img src="<? echo $appData->icon; ?>" width=100 alt="Facebook icon" /> <? echo $appData->title; ?></h1>
			<p><a class="btn btn-primary" role="button" href="<? echo $appData->url; ?>" target="_blank">Play Store &raquo;</a></p>
			</div>
		</div>

		<div class="container">
			<!-- Example row of columns -->
			<div class="row">
				<div class="col-md-4">
					<h2>Details</h2>
					<table class="table table-bordered table-condensed">
						<tbody>
							<tr><td><strong>Author</strong></td><td><? echo $appData->author; ?></td></tr>
							<tr><td><strong>Play Rating</strong></td><td><? echo $appData->playRating; ?></td></tr>
							<tr><td><strong>Category</strong></td><td><? echo $appData->category; ?></td></tr>
							<tr><td><strong>Cost</strong></td><td><? echo $appData->cost; ?></td></tr>
							<tr><td><strong>Number of Downloads</strong></td><td><? echo $appData->numDownloads; ?></td></tr>
						</tbody>
					</table>
				</div>
				<div class="col-md-8">
					<h2>Harmful Permissions</h2>
					<p><? echo implode("<br />\n", explode(", ", $appData->permissions)); ?></p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h2>Description</h2>
					<p><? echo $appData->description; ?></p>
				</div>
			</div>
			<hr>

			<footer>
			<p>&copy; Jacob Roeland 2013 &mdash; Released under WTFPLv2</p>
			</footer>
		</div> <!-- /container -->


		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
		<script src="./bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>
