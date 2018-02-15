
<?php

$csvString = file_get_contents('http://192.168.4.1');

$data = str_getcsv($csvString, "\n"); 
foreach($data as &$row) 
{
    $row = str_getcsv($row, ";");
    $timestamp = strtotime($row[1]) - 3600;
    $token = $row[2];

    $request = 'http://localhost/rfidtime.php?rfid=' . $token . '&time=' . $timestamp;
	
    //echo $request;
    file_get_contents($request);

    file_get_contents('http://192.168.4.1/delete');
}

?>
