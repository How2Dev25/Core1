<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\guestnotification;

class GuestNotif extends Component
{
    /** @var \Illuminate\Database\Eloquent\Collection */
    public $notifications;

    public function mount()
    {
        $this->fetchNotifications();
    }

    public function fetchNotifications()
    {
        $guest = Auth::guard('guest')->user();

        if (!$guest) {
            $this->notifications = collect();
            return;
        }

        $this->notifications = guestnotification::where('guestID', $guest->guestID)
            ->latest()
            ->get();
    }

    public function clearAll()
    {
        try {
            if ($this->notifications->isEmpty()) {
                session()->flash('info', 'No notifications to clear.');
                return;
            }

            // Delete only this guest’s notifications
            guestnotification::where('guestID', Auth::guard('guest')->user()->guestID)->delete();

            // Reset the local list
            $this->notifications = collect();

            session()->flash('success', 'All notifications cleared successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'Something went wrong while clearing notifications.');
        }
    }

    public function removeNotification($notificationId)
    {
        try {
            $notification = guestnotification::find($notificationId);

            if (!$notification) {
                session()->flash('info', 'Notification not found.');
                return;
            }

            // Make sure the logged-in guest owns this notification
            if ($notification->guestID !== Auth::guard('guest')->user()->guestID) {
                session()->flash('error', 'You are not authorized to delete this notification.');
                return;
            }

            $notification->delete();

            // Refresh the list
            $this->fetchNotifications();

            session()->flash('success', 'Notification removed successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred while removing the notification.');
        }
    }

    public function render()
    {
        return view('livewire.guest-notif');
    }
}
