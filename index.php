<?php
error_reporting(0);

	
	// Load the Google API PHP Client Library.
 	require_once 'vendor/autoload.php';
	
function initializeAnalytics(){
	
	// Use the developers console and download your service account
	// credentials in JSON format. Place them in this directory or
	// change the key file location if necessary.
	$KEY_FILE_LOCATION = 'google-api/key.json';
	// Create and configure a new client object.
	$client = new Google_Client();
	$client->setApplicationName("Hello Analytics Reporting");
	$client->setAuthConfig($KEY_FILE_LOCATION);
	$client->setScopes(['https://www.googleapis.com/auth/analytics.readonly']);
	$analytics = new Google_Service_AnalyticsReporting($client);

	return $analytics;
}

//this function call only page name and views
function getReportPageViews($analytics, $start_date, $end_date) {

	// Replace with your view ID, for example XXXX.
	$VIEW_ID = "246840739";
	// Create the DateRange object.
	$dateRange = new Google_Service_AnalyticsReporting_DateRange();
	$dateRange->setStartDate($start_date);
	$dateRange->setEndDate($end_date);
		
		
	//Create the Dimensions object.
	$pageTitle = new Google_Service_AnalyticsReporting_Dimension();
	$pageTitle->setName("ga:pageTitle");
	
	$browser = new Google_Service_AnalyticsReporting_Dimension();
	$browser->setName("ga:browser");
	
	$country = new Google_Service_AnalyticsReporting_Dimension();
	$country->setName("ga:country");
	
	$deviceCategory = new Google_Service_AnalyticsReporting_Dimension();
	$deviceCategory->setName("ga:deviceCategory");
	
	$city = new Google_Service_AnalyticsReporting_Dimension();
	$city->setName("ga:city");
	
	
	
	$pageviews = new Google_Service_AnalyticsReporting_Metric();
	$pageviews->setExpression("ga:pageviews");
	$pageviews->setAlias("pageviews");
	
	$sessions = new Google_Service_AnalyticsReporting_Metric();
	$sessions->setExpression("ga:sessions");
	$sessions->setAlias("sessions");
		
		
	
	
	// Create the ReportRequest object.
	$request = new Google_Service_AnalyticsReporting_ReportRequest();
	$request->setViewId($VIEW_ID);
	$request->setDateRanges($dateRange);
	$request->setDimensions(array($pageTitle,$browser,$country,$deviceCategory,$city));
	$request->setMetrics(array($pageviews, $sessions));
	
	$body = new Google_Service_AnalyticsReporting_GetReportsRequest();
	$body->setReportRequests( array( $request) );
	return $analytics->reports->batchGet( $body );
}



function getLatestDataPagesTitle($data){
	$analytics =initializeAnalytics();
	$i=0;
	$start  = date('Y-m-d', strtotime('+1 day'));
	for($j = 31; $j>0; $j--){
		
		$start_date =  date('Y-m-d', strtotime("-$j day", strtotime($start)));
		$d = new DateTime($start_date);
		$end_date = $d->format('Y-m-d');
	
		$response[$j] = getReportPageViews($analytics, $start_date, $end_date);
		$i++;
		$output[$i] = new stdClass();
		$output[$i]->start_date = $start_date;
		$output[$i]->end_date = $end_date;
		
		$output[$i]->pagePath 				= $response[$j]['reports'][0]['data']['rows'][0]['dimensions'][0];
		$output[$i]->browser 				= $response[$j]['reports'][0]['data']['rows'][0]['dimensions'][1];
		$output[$i]->country 				= $response[$j]['reports'][0]['data']['rows'][0]['dimensions'][2];
		$output[$i]->deviceCategory 		= $response[$j]['reports'][0]['data']['rows'][0]['dimensions'][3];
		$output[$i]->city 					= $response[$j]['reports'][0]['data']['rows'][0]['dimensions'][4];
		
		$output[$i]->pageView 				= $response[$j]['reports'][0]['data']['rows'][0]['metrics'][0]['values'][0];
		$output[$i]->sessions 				= $response[$j]['reports'][0]['data']['rows'][0]['metrics'][0]['values'][1];
		
		
	}
		
	return $output;
} 
 





$reports_data = getLatestDataPagesTitle($data);

$dataInJson = json_encode($reports_data);
$jsonDecode = json_decode($dataInJson,true);

echo "<pre>";
print_r($jsonDecode);
echo "</pre>";



 

?>
