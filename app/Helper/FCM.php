<?php


namespace App\Helper;


use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;


class FCM
{
    public static $from="";
    public static  $login_name="";
    public static  $login_password="AIzaSyDOe6Sh5Kozl346QRGqfWI-sG0vLi3_reU";
    public static  $baseURL="https://fcm.googleapis.com/fcm/send";
    public static $secretlegalekey='Key:AAAAnKp5W5c:APA91bFU_w6T-sQkBwZtToaOp8gm-bdHpdmQgdXk3CNxy1CZWQeedymXPuiOTMXnd-r2kHQcNAxgRqUXq6P1yIksiuiG3ZzjkFq0bc0y6WeurzsLCKMeHAoKsytD0tmsvSkkUY60FUik';

    public static  function  sendweb($to= "",$title= "",$messege= ""){

        $notification = array('title' =>$title , 'body' => $messege);
        $arrayToSend = array('to' => $to, 'notification' => $notification,'priority'=>'high');
        $json = json_encode($arrayToSend);
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: key='. Self::$secretlegalekey;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, self::$baseURL);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
        //Send the request
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        //Close request
        if ($response === FALSE) {
            die('FCM Send Error: ' . curl_error($ch));
        }
        curl_close($ch);
        return $response;
    }

    public static  function  send($to= "",$title= "",$messege= "",$data=[]){


        $url = "https://fcm.googleapis.com/fcm/send";
        $token = $to;
        $serverKey = Self::$login_password;
        $title = $title;
        $body = $messege;
        $notification = array('title' =>$title , 'body' => $body, 'sound' => 'default', 'badge' => '1',$data);
        $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high','data'=>$data);
        $json = json_encode($arrayToSend);
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: key='. $serverKey;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
        //Send the request
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        //Close request
        if ($response === FALSE) {
            die('FCM Send Error: ' . curl_error($ch));
        }
        curl_close($ch);

    }

    public static  function sendNotificationToAll($title= "",$messege= "", $customData = []){


        $serverKey = self::$login_password;

        if($serverKey != ""){


            $url = "https://fcm.googleapis.com/fcm/send";

            $serverKey = self::$login_password;


            $data =
                [
                    "to" => '/topics/all',
                    "notification" => [
                        "body" => $messege,
                        "title" => $title,
                    ],
                    "data" => $customData
                ];
            $json = json_encode($data);
            $headers = array();
            $headers[] = 'Content-Type: application/json';
            $headers[] = 'Authorization: key='. $serverKey;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
            curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
            //Send the request
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            $response = curl_exec($ch);
            print_r($response);
            exit;
            //Close request
            if ($response === FALSE) {
                die('FCM Send Error: ' . curl_error($ch));
            }
            curl_close($ch);

        }
        return false;
    }

    public static  function  sendForListUsers($to= [],$title= "",$messege= "",$data=[]){


        $url = "https://fcm.googleapis.com/fcm/send";
        $token = $to;
        $serverKey = Self::$login_password;
        $title = $title;
        $body = $messege;
        $notification = array('title' =>$title , 'body' => $body, 'sound' => 'default', 'badge' => '1',$data);
        $arrayToSend = array('registration_ids' => $token, 'notification' => $notification,'priority'=>'high');
        $json = json_encode($arrayToSend);
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: key='. $serverKey;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
        //Send the request
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        //Close request
        if ($response === FALSE) {
            die('FCM Send Error: ' . curl_error($ch));
        }
        curl_close($ch);

    }

    public static  function sentMessageToFireBase($data){
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/text.json');

        $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            // The following line is optional if the project id in your credentials file
            // is identical to the subdomain of your Firebase project. If you need it,
            // make sure to replace the URL with the URL of your project.
            ->withDatabaseUri('https://hassan-54ad5.firebaseio.com/')
            ->create();

        $database = $firebase->getDatabase();

        $newPost = $database
            ->getReference('blog/posts')
            ->push([
                'message_id'=>$data['message_id'],
                'uuid'=>$data['uuid'],
                'sender' => $data['sender_user_id'],
                'receiver' => $data['receiver_user_id'],
                'text'=>$data['text'],
                'date'=>$data['created_at'],
            ]);

        $newPost->getKey(); // => -KVr5eu8gcTv7_AHb-3-
        $newPost->getUri(); // => https://my-project.firebaseio.com/blog/posts/-KVr5eu8gcTv7_AHb-3-

        $newPost->getChild('title')->set('Changed post title');
        $newPost->getValue(); // Fetches the data from the realtime database
        $newPost->remove();
    }

    public  static  function  sendwebNotifcation($to= "",$title= "",$messege= "",$data=[]){

        $url = "https://fcm.googleapis.com/fcm/send";
        $token = $to;
        $serverKey = Self::$login_password;
        $title = $title;
        $body = $messege;
        $notification = array('title' =>$title , 'body' => $body, 'sound' => 'default', 'badge' => '1',$data);
        $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high','data'=>$data);
        $json = json_encode($arrayToSend);
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: key='. $serverKey;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
        //Send the request
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        //Close request
        if ($response === FALSE) {
            die('FCM Send Error: ' . curl_error($ch));
        }
        curl_close($ch);
    }

    public  static  function  sendwebNotifcationUsers($to= [],$title= "",$messege= "",$data=[]){

        $url = "https://fcm.googleapis.com/fcm/send";
        $token = $to;
        $serverKey = Self::$login_password;
        $title = $title;
        $body = $messege;
        $notification = array('title' =>$title , 'body' => $body, 'sound' => 'default', 'badge' => '1',$data);
        $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high','data'=>$data);
        $json = json_encode($arrayToSend);
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: key='. $serverKey;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
        //Send the request
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        //Close request
        if ($response === FALSE) {
            die('FCM Send Error: ' . curl_error($ch));
        }
        curl_close($ch);
    }
}