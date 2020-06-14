<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record_status extends Model
{
     // Table Name
     protected $table = 'record_status';
     //Primary Key
     protected $primaryKey = 'record_status_id';
     // Timestamps
     public $timestamps = true;

     public function device_status() {
         return $this->brlongsTo('App\Record_status');
     }
}
