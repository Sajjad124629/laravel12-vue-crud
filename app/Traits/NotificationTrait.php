<?php 
namespace App\Traits;
use App\Models\Notification;
trait NotificationTrait {
    public function createNotification($user_id, $title, $notification_type, $sender_image = null) {
        return Notification::create([
            'user_id' => $user_id,
            'title' => $title,
            'notification_type' => $notification_type,
            'sender_image' => $sender_image,
        ]);
    }
}
