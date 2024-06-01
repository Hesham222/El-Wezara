<?php

namespace App\Services;

use Kreait\Firebase\Factory;

class FirebaseService
{
    private $conf_file_path;
    private $serviceAccount;
    private $factory;

    /**
     * FirebaseController constructor.
     */
    public function __construct()
    {
        $this->conf_file_path = storage_path('app' . DIRECTORY_SEPARATOR . 'FIREBASE_CONF.json');
        //$this->serviceAccount = ServiceAccount::fromJsonFile($this->conf_file_path);
        $this->factory = (new Factory)->withServiceAccount($this->conf_file_path);
    }

    public function refreshCS()
    {
        $database = $this->factory->withDatabaseUri('https://elwezara-f65c8-default-rtdb.europe-west1.firebasedatabase.app/')->createDatabase();
        $ref = $database->getReference('carts');
        $key = $ref->push()->getKey();
        $ref->getChild($key)->set([
            'order' => 1
        ]);
    }




    public function refreshPrepArea($id)
    {
        $database = $this->factory->withDatabaseUri('https://elwezara-f65c8-default-rtdb.europe-west1.firebasedatabase.app/')->createDatabase();
        $ref = $database->getReference('carts');
        $key = $ref->push()->getKey();
        $ref->getChild($key)->set([
            'area_id' => $id
        ]);
    }


    public function fillAndroidJson($data)
    {
        $json =  array();
        $json['title'] = $data['title'];
        $json['body'] = $data['message'];
        $json['type'] = intval($data['type']);
        $json['id'] = intval($data['order']);
        $json['searchKey'] = $data['searchKey'];
        return $json;
    }

    public function fillIOSJson($title,$body)
    {
        $json['title'] = $title;
        $json['body'] = $body;
        $json['sound'] = 'default';
        return $json;
    }

    public function sendNewAndroidNotification($tokens,$json)
    {
        if (is_array($tokens))
            $tokenIds = $tokens;
        else
            $tokenIds = [$tokens];

        define('SERVER_KEY', 'AAAAtwcktWE:APA91bGjEf9Foe97pFF_Yl6l_UWHAWPwnMJNs6AAf9qQgBtRKfgMWql1Lw98c6RXXIqBznc2DdKIrBnveizjyINv6z31C87XQmk4YKPzW46qwm6l8M1zQhvhJHQkCo-1QvShkpVxT0ns');

        $fields = array
        (
            'registration_ids'  => $tokenIds,
            'data' => $json
        );

        $headers = array
        (
            'Authorization: key=' . SERVER_KEY,
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch,CURLOPT_POST, true);
        curl_setopt($ch,CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch,CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch );

        if ($result === FALSE)
        {
            die('FCM Send Error: ' . curl_error($ch));
        }

        $result = json_decode($result,true);
        curl_close( $ch );

        $response['firebase'] = $result;
        $response['json'] = $fields;
        return $response;
    }

    public function sendIOSNotification($tokens,$json,$data)
    {
        if (is_array($tokens))
            $tokenIds = $tokens;
        else
            $tokenIds = [$tokens];

        $url = "https://fcm.googleapis.com/fcm/send";
        $serverKey = 'AAAAtwcktWE:APA91bGjEf9Foe97pFF_Yl6l_UWHAWPwnMJNs6AAf9qQgBtRKfgMWql1Lw98c6RXXIqBznc2DdKIrBnveizjyINv6z31C87XQmk4YKPzW46qwm6l8M1zQhvhJHQkCo-1QvShkpVxT0ns';
        $arrayToSend = array('content_available' => true, 'registration_ids' => $tokenIds,'data' => $data,'notification' => $json,'priority'=>'high');
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: key='. $serverKey;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrayToSend));
        curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //Send the request
        $result = curl_exec($ch);
        if ($result === FALSE)
        {
            die('FCM Send Error: ' . curl_error($ch));
        }
        $result = json_decode($result,true);
        //Close request
        curl_close($ch);
        $response['firebase'] = $result;
        $response['json'] = $arrayToSend;
        return $response;
        //return $result;*/
    }

    public function sendNotification($data, $notification, $userToken, $deviceType)
    {
        if ($deviceType == 'IOS') {
            $json = $this->fillIOSJson($notification['title'], $notification['body']);
            $this->sendIOSNotification($userToken, $json, $data);
        } else {
            $this->sendAndroidNotification($data, $userToken);
        }
    }
}
