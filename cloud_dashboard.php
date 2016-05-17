<?php
$url1=$_SERVER['REQUEST_URI'];
header("Refresh: 300; URL=$url1");

require('./razorflow_php/razorflow.php');
require 'vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\Common\Credentials\Credentials;
use Aws\CloudWatch\CloudWatchClient;


class Application1 extends Dashboard {
  public function buildDashboard(){
	  
	#AWS API's  
	$credentials = new Credentials('AKIAI2HAXALKFOXUXW5A', 'wpP3m5gU9z2u9Hlf57wiubXqGm5nW+ojrzKEPB52');
	$s3Client = S3Client::factory(array('credentials' => $credentials));
	$client = CloudWatchClient::factory(array( 'credentials' => $credentials,'region'  => 'us-west-2'));

	$dimensions = array( array('Name' => 'InstanceId', 'Value' => 'i-06e1fd3a533d470e8'),);
	$metrics = $client->listMetrics(array('Namespace' => 'AWS/EC2'));
  
	$result = $client->getMetricStatistics(array(
						'Namespace'  => 'AWS/EC2',
						'MetricName' => 'CPUUtilization',
						'Dimensions' => $dimensions,
						'StartTime'  => strtotime('now -1 hour'),
						'EndTime'    => strtotime('now'),
						'Period'     => 300,
						'Statistics' => array('Maximum', 'Minimum'),));
	$label_area = array();
	$metrics1 = array();
	$label_area2 = array();
	$metrics2 = array();
	
	foreach ( $result->getAll()['Datapoints'] as $item ) {
		$max = $item['Maximum'];
		$time = $item['Timestamp'];
		#$time = substr($time,strpos($time,"T")+1);
		#$time = trim($time, "Z");
		array_push($label_area,$time);
		array_push($metrics1,$max);
		array_push($label_area2,$time);
		array_push($metrics2,$max+10);
		
	}
	
	sort($label_area);
	sort($metrics1);

	#Get the metrics	
	#$metrics1 = array(420000,460000, 480000, 520000, 560000, 510000, 470000, 430000, 420000, 370000, 360000, 360000,380000);
		
    $chart = new ChartComponent("AmazonWebServices");
    $chart->setCaption("aws_cloudwatch_vmplayer");
    $chart->setDimensions (6, 5);
    #$chart->setLabels (array("0:0:0", "5", "10", "15", "20", "25", "30", "35", "40", "45", "50", "55","60"));
    $chart->setLabels ($label_area);
	$chart->addSeries ("CPU utilization", "2016-05-05", $metrics1, array( "seriesDisplayType"=> "area"));
    $chart->setYAxis('CPU Utilization');

	#$metrics2 = array(460000,460000, 470000, 520000, 560000, 520000, 470000, 430000, 420000, 380000, 360000, 360000,390000);
	$chart1 = new ChartComponent("WindowsAzure");
    $chart1->setCaption("azure_vmplayer");
    $chart1->setDimensions (6, 5);
    #$chart1->setLabels (array("0", "5", "10", "15", "20", "25", "30", "35", "40", "45", "50", "55","60"));
	$chart1->setLabels ($label_area2);
    $chart1->addSeries ("CPU utilization", "2016-05-05", $metrics2,array( "seriesDisplayType"=> "area"));
    $chart1->setYAxis('CPU Utilization');

    $this->setDashboardTitle('Application1');
    $this->setActive();
    $this->addComponent ($chart);
	$this->addComponent ($chart1);
  }
}

class Application2 extends Dashboard {
  public function buildDashboard(){
	$metrics = array(420000,460000, 480000, 520000, 560000, 510000, 470000, 430000, 420000, 370000, 360000, 360000,380000);
		
    $chart = new ChartComponent("AmazonWebServices");
    $chart->setCaption("aws_cloudwatch_vmplayer");
    $chart->setDimensions (6, 5);
    $chart->setLabels (array("0", "5", "10", "15", "20", "25", "30", "35", "40", "45", "50", "55","60"));
    $chart->addSeries ("CPU utilization", "2016-05-05", $metrics, array( "seriesDisplayType"=> "area"));
    $chart->setYAxis('CPU Utilization');

	$metrics1 = array(460000,460000, 470000, 520000, 560000, 520000, 470000, 430000, 420000, 380000, 360000, 360000,390000);
	$chart1 = new ChartComponent("WindowsAzure");
    $chart1->setCaption("azure_vmplayer");
    $chart1->setDimensions (6, 5);
    $chart1->setLabels (array("0", "5", "10", "15", "20", "25", "30", "35", "40", "45", "50", "55","60"));
    $chart1->addSeries ("CPU utilization", "2016-05-05", $metrics1,array( "seriesDisplayType"=> "area"));
    $chart1->setYAxis('CPU Utilization');

    $this->setDashboardTitle('Application2');
    $this->setActive();
    $this->addComponent ($chart);
	$this->addComponent ($chart1);
  }
}
  
class Application3 extends Dashboard {
  public function buildDashboard(){
	
    $metrics = array();
    for ($x = 0; $x <= 10; $x++) {
		$metrics[$x] = $x;
		
		$chart = new ChartComponent("AmazonWebServices");
		$chart->setCaption("aws_cloudwatch_vmplayer");
		$chart->setDimensions (6, 5);
		$chart->setLabels (array("0", "5", "10", "15", "20", "25", "30", "35", "40", "45", "50", "55","60"));
		$chart->addSeries ("CPU utilization", "2016-05-05", $metrics, array( "seriesDisplayType"=> "area"));
		$chart->setYAxis('CPU Utilization');
	}
	
	$metrics1 = array(460000,460000, 470000, 520000, 560000, 520000, 470000, 430000, 420000, 380000, 360000, 360000,390000);
	$chart1 = new ChartComponent("WindowsAzure");
    $chart1->setCaption("azure_vmplayer");
    $chart1->setDimensions (6, 5);
    $chart1->setLabels (array("0", "5", "10", "15", "20", "25", "30", "35", "40", "45", "50", "55","60"));
    $chart1->addSeries ("CPU utilization", "2016-05-05", $metrics1,array( "seriesDisplayType"=> "area"));
    $chart1->setYAxis('CPU Utilization');

    $this->setDashboardTitle('Application3');
    $this->setActive();
    $this->addComponent ($chart);
	$this->addComponent ($chart1);
  }
}


class MyDashboard extends TabbedDashboard {
  public function buildDashboard () {
    $app1 = new Application1();
    $app2 = new Application2();
    $app3 = new Application3();	

    $this->setTabbedDashboardTitle("Cross cloud Management");
    $this->addDashboardTab($app1);
    $this->addDashboardTab($app2);
	$this->addDashboardTab($app3);
	
  }
}



$dashboard = new MyDashboard ();
$dashboard->renderStandalone ();
?>