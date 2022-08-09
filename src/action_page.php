<?php
$configs = include('config.php');

if ( isset($_POST['name']) && isset($_POST['number']) && isset($_POST['email'])) {
    $name=htmlspecialchars($_POST['name']);
    $email=htmlspecialchars($_POST['email']);
    $number=htmlspecialchars($_POST['number']);

    var_dump($name);
    var_dump($configs['event_id']);
    var_dump($configs['backend_hostname']);
    var_dump($configs['backend_port']);

    if(!is_numeric($number) || empty($name) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("location: /?message=failure");
    } else {
        $url = 'http://' . $configs['backend_hostname'] . ':' . $configs['backend_port'] . '/rsvps';

        var_dump($url);
    
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
        $headers = array(
        "Accept: application/json",
        "Content-Type: application/json",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    
    
        $data = <<<DATA
        {
        "guest_name": "{$name}",
        "email": "{$email}",
        "number_guests": {$number},
        "event_id": {$configs['event_id']}
        }
        DATA;
    
        var_dump($data);
    
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    
        $resp = curl_exec($curl);
        curl_close($curl);
        var_dump($resp);

        if ( $resp == false) {
            header("location: /?message=failure");
        } else {
            header("location: /?message=success");
        }
    }
    
} else {
    header("location: /?message=failure");
}
die;    