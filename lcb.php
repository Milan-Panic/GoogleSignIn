<?php
$ch = curl_init('https://lcb.org/feed/regions.json?token=QoM03RoqwHYY5');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$data = curl_exec($ch);
curl_close($ch);
unset($ch);



print_r($data);




?>