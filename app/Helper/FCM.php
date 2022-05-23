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
    public static $secretlegalekey='AAAAJhFjbbo:APA91bGa9hPgrwV_fAeSd0dRvEPKD24SbJxclgBXQ_oW8fEpp7-EgWFp9fiGzr2K3GCDfmTObnDXAJzzpa5h7-LFj-8JwETfxGu5NScu0xyC1b5iMRz-p7X4sranpFxqv4r7s17BmMII';

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