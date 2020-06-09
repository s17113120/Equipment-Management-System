<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    // Table Name
    protected $table = 'devices';
    //Primary Key
    protected $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    public function device() {
        return $this->brlongsTo('App\Device');
    }
}
