<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_status extends Model
{
    // Table Name
    protected $table = 'user_status';
    //Primary Key
    protected $primaryKey = 'user_status_id';
    // Timestamps
    public $timestamps = true;

    public function user_status() {
        return $this->brlongsTo('App\User_status');
    }
}
