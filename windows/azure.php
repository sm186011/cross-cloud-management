<?php

require_once 'vendor\autoload.php';

use WindowsAzure\Common\ServicesBuilder;
use WindowsAzure\Common\ServiceException;

$connectionString = "DefaultEndpointsProtocol=https;AccountName=39portalvhdst059h6pkzdl1;AccountKey=uckJXfHvUy+EDU/z8DwQI85nAGK/J0qJ+GXfhrcGZdmStFgsbWNhkUXLpaHHeta2KQ2YubLY2NFx5aesNhRurQ==";
// Create blob REST proxy.
$blobRestProxy = ServicesBuilder::getInstance()->createBlobService($connectionString);


try {
    // List blobs.
    $blob_list = $blobRestProxy->listBlobs("vhds");
    $blobs = $blob_list->getBlobs();

    foreach($blobs as $blob)
    {
        echo $blob->getName().": ".$blob->getUrl()."<br />";
		$blob = $blobRestProxy->getBlob("vhds", $blob->getName());
		fpassthru($blob->getContentStream());
    }
}
catch(ServiceException $e){
    // Handle exception based on error codes and messages.
    // Error codes and messages are here:
    // http://msdn.microsoft.com/library/azure/dd179439.aspx
    $code = $e->getCode();
    $error_message = $e->getMessage();
    echo $code.": ".$error_message."<br />";
}

?>