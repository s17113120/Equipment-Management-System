<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device_status extends Model
{
    // Table Name
    protected $table = 'device_status';
    //Primary Key
    protected $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    public function device_status() {
        return $this->brlongsTo('App\Device_status');
    }
}
