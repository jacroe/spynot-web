<?php
require "spynot.php";
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>Spynot!</title>

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
			<h1>Spynot!</h1>
			<p>The Spynot project was an undertaking that involved gathering Android application data and manipulating that data in a way to inform the user of potentially questionable applications. Questionability of an application could be determined in a myriad of ways including, but not limited to the total number of permissions asked from the application, evaluating the permissions asked and category of the application, number of application downloads, and the Google play rating of the application.</p>
			<p><a class="btn btn-primary btn-lg" role="button" href="info.php" onclick="d = ['https://www.youtube.com/watch?v=JdbrmnrQuh0', 'https://www.youtube.com/watch?v=ZZ5LpwO-An4', 'https://www.youtube.com/watch?v=2Z4m4lnjxkY', 'https://www.youtube.com/watch?v=xqKPe9w5bUs']; window.location = d[Math.floor(Math.random() * (3 - 0 + 1) + 0)]; return false;">Learn more &raquo;</a></p>
			</div>
		</div>

		<div class="container">
			<!-- Example row of columns -->
			<div class="row">
			<div class="col-md-4">
				<h2>Search for an App</h2>
				<form class="form-inline" role="form" method="GET" action="search.php">
					<div class="form-group">
						<label class="sr-only" for="searchString">Search String</label>
						<input type="text" class="form-control" id="searchString" name="searchString" placeholder="Facebook" />
					</div>
					<button type="submit" class="btn btn-default">Search</button>
				</form>
			</div>
			<div class="col-md-4">
				<h2>View by Package Name</h2>
				<form class="form-inline" role="form" method="GET" action="view.php">
					<div class="form-group">
						<label class="sr-only" for="packageName">Search String</label>
						<input type="text" class="form-control" id="packageName" name="packageName" placeholder="com.facebook.katana" />
					</div>
					<button type="submit" class="btn btn-default">View</button>
				</form>
			</div>
			<div class="col-md-4">
				<h2>Last Searches</h2>
				<ol>
				<?php
				$lastSearch = mysql_settings_getLastSearch();
				foreach ($lastSearch as $d)
				{
					echo "<li><a href=\"search.php?searchString=$d\">$d</a></li>\n";
				}
				?>
				</ol>
			</div>
			</div>

			<hr>

			<footer>
			<p></p>
			<p>&copy; 2013 Jacob Roeland, Released under WTFPLv2<br />
			Cronjob last ran at <?php echo date("H:i", mysql_settings_getLastCron()); ?></p>
			</footer>
		</div> <!-- /container -->


		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
		<script src="./bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>
