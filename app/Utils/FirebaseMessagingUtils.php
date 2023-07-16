<?php

namespace  App\Utils;

class FirebaseMessagingUtils
{
    const FCM_TOKEN = "BHPxPBckNoknxkmDK8G9jPGA9bG2zTk3Ox7fMt6N0EV9sCYVU_a02ptVDXcu-Nfx4UpqupC7z6CJDAnxs-lj8CQ";

    public static function sendNotification($title, $body, $type, $customerNotification, $firebaseId){
        $url = 'https://fcm.googleapis.com/fcm/send';

        $fields = array(
           'to' => $firebaseId,
           "notification" => array(
                "title" => $title,
                "body" => $body,
                "type" => $type,
                "sound" => "default",
                "time_to_live" => 2419200
           ),
           "priority" => 'high',
           "data" => array(
               "click_action" => 'FLUTTER_NOTIFICATION_ACTION',
               'id' => "".$customerNotification['id'],
               "status" => 'done',
               "notification_type" => "". $customerNotification['type'],
               "notification_id" => "".$customerNotification['id'],
               "meta_data_id" => "".$customerNotification['meta_data_id'],
               "notification" => json_encode($customerNotification),
               "title" => $title,
               "body" => $body,
           ),
        );

        $fields = json_encode($fields);
        $headers = array(
           'Authorization : key='. self::FCM_TOKEN,
           "Content-Type: application/json"
        );

        $ch = curl_init();
        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_POST, true);
        curl_setopt ($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt ($ch, CURLOPT_POSTFIELDS, $fields);

        $result = curl_exec($ch);
        curl_close($ch);
       
        return $result;
    }
}
