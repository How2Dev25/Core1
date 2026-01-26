<?php

namespace App\Traits;

use App\Models\SyncQueue;

trait Syncable
{
    protected static function bootSyncable()
    {
        static::created(function ($model) {
            $model->queueSync('insert');
        });

        static::updated(function ($model) {
            $model->queueSync('update');
        });

        static::deleted(function ($model) {
            $model->queueSync('delete');
        });
    }

    public function queueSync($action)
    {
        SyncQueue::create([
            'model_name' => class_basename($this),      // e.g., 'Employee'
            'record_id'  => $this->getKey(),           // primary key
            'action'     => $action,
            'payload'    => json_encode($this->getAttributes()), // all fields
            'synced'     => false,
        ]);
    }
}
