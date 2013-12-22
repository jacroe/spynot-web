<?php
require_once "spynot.php";
$searchString = $_GET['searchString'];
$apps = spynot_getSearch($searchString);
mysql_settings_putLastSearch($searchString);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>Searched for "<? echo $searchString; ?>" | Spynot!</title>

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
			</div>
		</div>

		<!-- Main jumbotron for a primary marketing message or call to action -->
		<div class="jumbotron">
			<div class="container">
			<h1>Search results for &ldquo;<? echo $searchString; ?>&rdquo;</h1>
			</div>
		</div>
		<div class="container">
			<!-- Example row of columns -->
			<div class="row">
				<div class="col-md-12">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>#</th>
								<th>Icon</th>
								<th>App Name</th>
								<th>Author</th>
								<th>Play Rating</th>
								<th>Package Name</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$i = 0;
							foreach($apps as $app)
							{
								echo "<tr><td>$i</td><td><img src='{$app->icon}' alt='{$app->title} icon' width=25 /></td><td>{$app->title}</td><td>{$app->author}</td><td>{$app->playRating}</td><td><a href='view.php?packageName={$app->packageName}&searchString=$searchString'>{$app->packageName}</a></td></tr>";
								$i++;
							}
							?>
						</tbody>
					</table>
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
