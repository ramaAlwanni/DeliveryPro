<?php

namespace App\Http\Controllers;

use App\Trait\Response;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    use Response;

    public function showAllNotifications()
    {
        $user = auth()->user();
        $allNotifications = $user->notifications()->get();
        if(!$allNotifications){
            return $this->ErrorResponse('Error', 'There are not Notifications yet!', null, 400);
        }
        return $this->SuccessResponse('Success' , 'This is all Notifications for you' , $allNotifications ,200 );
    }
//---------------------------------------------------------------------------------------
    public function showNotificationDetails($id)
    {
        $notification = DatabaseNotification::find($id);
        if (!$notification) {
            return $this->ErrorResponse('Error', 'Notification not found!', null, 400);
        }
        return $this->SuccessResponse('Success', 'This is notification datails', $notification, 200);
    }
//---------------------------------------------------------------------------------------
    public function showUnReadNotifications()
    {
        $user = auth()->user();
        $unreadNotifications = $user->unreadNotifications()->get();
        if (!$unreadNotifications) {
            return $this->ErrorResponse('Error', 'There are not unread Notification yet!', null, 400);
        }
        return $this->SuccessResponse('Success', 'This is unread notifications', $unreadNotifications, 200);
    }
//---------------------------------------------------------------------------------------
    public function showCountUnReadNotifications()
    {
        $user = auth()->user();
        $countunreadNotifications =  $user->unreadNotifications()->count();
        if (!$countunreadNotifications) {
            return $this->ErrorResponse('Error', 'There are not unread Notification yet!', null, 400);
        }
        return $this->SuccessResponse('Success', 'This is count unread notifications', $countunreadNotifications, 200);
    }
//---------------------------------------------------------------------------------------
    public function makeAsRead($id)
    {
        $notification = DatabaseNotification::find($id);
        $notification->markAsRead();
        if (!$notification) {
            return $this->ErrorResponse('Error', 'Notification not found!', null, 400);
        }
        return $this->SuccessResponse('Success', 'Notification has been read', $notification, 200);
    }
//---------------------------------------------------------------------------------------
    public function makeAllAsRead() 
    {
        $user = auth()->user();
        $notifications = $user->unreadNotifications->markAsRead();
        if (!$notifications) {
            return $this->ErrorResponse('Error', 'Notifications not found!', null, 400);
        }
        return $this->SuccessResponse('Success', 'All notifications has been read', $notifications, 200);
    }
//---------------------------------------------------------------------------------------
    public function deleteAll() 
    {
        $user = auth()->user();
        $notifications = $user->notifications()->delete();
        if (!$notifications) {
            return $this->ErrorResponse('Error', 'Notifications not found!', null, 400);
        }
        return $this->SuccessResponse('Success', 'All notifications has been deleted', $notifications, 200);
    }
//---------------------------------------------------------------------------------------
    public function deleteNotification($id)
    {
        $notification = DatabaseNotification::find($id);
        $notification = $notification->delete();
        if (!$notification) {
            return $this->ErrorResponse('Error', 'Notifications not found!', null, 400);
        }
        return $this->SuccessResponse('Success', 'Notification has been deleted', $notification, 200);
    }
}
