# HtmlScrapingRequest

- Capture URL of the site your want to scrap.

- Capture selector, eg : img.thumbnail, ...

How to use
 1. Require class: `require_once 'class.HttpRequest.php';`
 2. Using: `$http = new Httprequest();`
 3. Using: `$http->setServer($_POST['domain']);
	if (isset($_POST['domain'])) { it is a URL of page that you want to scrap
		$http->setServer($_POST['domain']);
	}
	$html = $http->send();
	if (isset($html->error)) {
		echo json_encode($html); exit();
	}
	$result = $html->contents;
	if (isset($_POST['tag-element'])) { // it is a selector (img.thumbnail)
		$response = array();
		$checkData = $result->find($_POST['tag-element']);
		if (count($checkData)) {
			foreach ($checkData as $key => $check) {
				array_push($response, $check->outertext());
			}
		}
		echo json_encode($response); exit();  // Get your result -> by JSON or any format response
	}`

# Donations
I highly appreciate any of your donations.

[![paypal](https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif)](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=FLHJAF2ECGXGQ)
