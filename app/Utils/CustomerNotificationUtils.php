<?php

namespace App\Utils;

use App\Models\CustomerDevice;

class CustomerNotificationUtils
{
   public static function notify($notification)
   {
      // Get customer devices firebase token in datatabase
      $devices = CustomerDevice::where(['customer_id' => $notification->customer_id])->get();

      $arrayNotification = $notification->toArray();

      $results = [];
      foreach($devices as $device){
        $res = FirebaseMessagingUtils::sendNotification(
            $title = $notification->title,
            $body = $notification->body,
            $type = $notification->type,
            $customerNotification = $arrayNotification,
            $firebaseId = $device->firebase_id
        );

        $results[] = $res;
      }

      return $results;

   } 
}
?>