<?php
function getDepth($exchange, $product, $level) {

    $url = 'http://3.140.175.176:3000/depths/';
    $data = array('exchangeName' => $exchange, 'productName' => $product, 'token' => 'not_in_place_yet', 'level' => $level);
    // use key 'http' even if you send the request to https://...
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'GET',
            'content' => http_build_query($data),
        ),
    );
    echo $url . http_build_query($data);
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    return $result;
    
    }
echo getDepth('TEST','test',1);
?>
