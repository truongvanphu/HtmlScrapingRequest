<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	scraping();
	
}
function scraping()
{
	require_once 'class.Httprequest.php';
	$http = new Httprequest();
	if (isset($_POST['domain'])) {
		$http->setServer($_POST['domain']);
	}
	$html = $http->send();
	if (isset($html->error)) {
		echo json_encode($html); exit();
	}
	$result = $html->contents;
	if (isset($_POST['tag-element'])) {
		$response = array();
		$checkData = $result->find($_POST['tag-element']);
		if (count($checkData)) {
			foreach ($checkData as $key => $check) {
				array_push($response, $check->outertext());
			}
		}
		echo json_encode($response); exit();
	}
}					

?>
<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Title Page</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<div class="container-fluid">
			<div class="page-header">
			  <h1>Scraping html tag elements<small> v1.0</small></h1>
			</div>
			<div class="container-fluid">
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<div class="panel panel-info">
						<div class="panel-heading">
							<h3 class="panel-title">Scraping options</h3>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<form action="" method="POST" class="form" role="form">
										<div class="form-group">
											<label class="" for="">URL scraping: <span> http://example.com</span></label>
											<input type="text" name="domain" id="inputURL" class="form-control" value="" required="required" title="URL Scrap target" placeholder="Enter a domain">
										</div>
										<div class="form-group">
											<label class="" for="">Tag finds: <span>(#elements, .classes)</span></label>
											<input type="text" name="tag-element" id="inputTagElement" class="form-control" value="" required="required" title="Target finds" placeholder="Enter a html tag elements">
										</div>
										<div class="form-group">
											<label class="" for="">Display type</label>
											<div class="radio">
												<label>
													<input type="radio" name="display-html" value="0">
													Html elements
												</label>
											</div>
											<div class="radio">
												<label>
													<input type="radio" name="display-html" value="1" checked="checked">
													Html string
												</label>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
												<div class="col-sm-12">
													<button type="submit" class="btn btn-primary pull-right">Submit</button>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<div class="panel panel-info">
						<div class="panel-heading">
							<h3 class="panel-title">Respond Scraping</h3>
						</div>
						<div class="panel-body" style="text-align: center;overflow: scroll;">
							Display result Html here
							<div id="result" style="text-align: center;">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
 		<script src="js/script.js"></script>
	</body>
</html>