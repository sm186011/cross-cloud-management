<?php

require 'vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\Common\Credentials\Credentials;
use Aws\CloudWatch\CloudWatchClient;


$credentials = new Credentials('AKIAI2HAXALKFOXUXW5A', 'wpP3m5gU9z2u9Hlf57wiubXqGm5nW+ojrzKEPB52');

$s3Client = S3Client::factory(array(
    'credentials' => $credentials
));


$client = CloudWatchClient::factory(array(
    'credentials' => $credentials,
    'region'  => 'us-west-2'
));

$dimensions = array(
    array('Name' => 'InstanceId', 'Value' => 'i-06e1fd3a533d470e8'),
);

$metrics = $client->listMetrics(array('Namespace' => 'AWS/EC2'));

#we can get the statistics for multiple matrics like cpuutilization, I/O utilization using below statements
#foreach($metrics['Metrics'] as $metric)
#{
#	foreach($metric['Dimensions'] as $dimension)
#	{		
#		printf("%s %s %s=%s\n",$metric['Namespace'], $metric['MetricName'],$dimension['Name'], $dimension['Value']);
#		echo "<br/>";
#	}
#}


$result = $client->getMetricStatistics(array(
						'Namespace'  => 'AWS/EC2',
						'MetricName' => 'CPUUtilization',
						'Dimensions' => $dimensions,
						'StartTime'  => strtotime('now -1 hour'),
						'EndTime'    => strtotime('now'),
						'Period'     => 300,
						'Statistics' => array('Maximum', 'Minimum'),
		));
		
foreach ( $result->getAll()['Datapoints'] as $item ) {
    $max = $item['Maximum'];
    $time = $item['Timestamp'];
	$time =  substr($time,strpos($time,"T")+1,strpos($time,"Z"));
	$time = trim($time, "Z");
	echo $time;
    #print "$time -- max $max\n";
}


  
#echo $result->get(0);
#echo "\n";		
#echo $result;
?>
