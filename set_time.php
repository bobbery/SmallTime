
<?php

    $timestamp = strtotime("now") + 3600;
    $request = 'http://192.168.4.1/time?clk=' . $timestamp;
    $answer = file_get_contents($request);

    print($answer);
?>
