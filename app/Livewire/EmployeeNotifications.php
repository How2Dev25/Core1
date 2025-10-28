<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\employeenotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

class EmployeeNotifications extends Component
{
    /** @var \Illuminate\Database\Eloquent\Collection */
    public $notifications;

    public function mount()
    {
        $this->fetchNotifications();
    }

    public function fetchNotifications()
    {
        $userRole = Auth::user()->role;

        // Define shared access per module
        $roleAccess = [
            'Front Desk' => ['Hotel Admin', 'Receptionist'],
            'Room Management' => ['Hotel Admin', 'Room Attendant', 'Room Manager', 'Maintenance Staff'],
            'CRM' => ['Hotel Admin', 'Guest Relationship Head', 'Receptionist'],
            'Billing' => ['Hotel Admin', 'Receptionist'],
            'Stocks Management' => ['Hotel Admin', 'Material Custodian', 'Hotel Inventory Manager'],
            'Marketing' => ['Hotel Admin', 'Hotel Marketing Officer', 'Receptionist'],
            'Event & Conference' => ['Hotel Admin'],
            'Integration' => ['Hotel Admin'],
            'Security' => ['Hotel Admin'],
        ];

        $allowedModules = collect($roleAccess)
            ->filter(fn($roles) => in_array($userRole, $roles))
            ->keys()
            ->toArray();

        // Fetch as Collection (not array)
        $this->notifications = employeenotification::whereIn('module', $allowedModules)
            ->orderBy('notificationempID', 'desc')
            ->get();
    }

    public function clearAll()
    {
        try {
            if ($this->notifications->isEmpty()) {
                session()->flash('info', 'No notifications to clear.');
                return;
            }

            employeenotification::truncate();
            $this->notifications = collect(); // Reset to an empty collection
            session()->flash('success', 'All notifications cleared successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'Something went wrong while clearing notifications.');
        }
    }

      public function removeNotification($notificationId)
    {
        try {
            $notification = employeenotification::find($notificationId);

            if (!$notification) {
                session()->flash('info', 'Notification not found.');
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
        return view('livewire.employee-notifications');
    }
}
