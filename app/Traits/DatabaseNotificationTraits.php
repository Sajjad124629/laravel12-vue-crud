<?php 
namespace App\Traits;

use App\Models\Notification;

trait DatabaseNotificationTraits{
    public function notify($user_id,$sender_image = null,$title,$description=null,$notification_type = 'info'){
      Notification::create([
        'user_id' => $user_id,
        'sender_image' => $sender_image,
        'title' => $title,
        'description' => $description,
        'notification_type' => $notification_type
      ]);
    }
}