<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    // Table Name
    protected $table = 'devices';
    //Primary Key
    protected $primaryKey = 'device_id';
    // Timestamps
    public $timestamps = true;

    public function user() {
        return $this->brlongsTo('App\Device');
    }
}
