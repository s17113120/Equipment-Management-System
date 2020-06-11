<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    // Table Name
    protected $table = 'users';
    //Primary Key
    protected $primaryKey = 'user_id';
    // Timestamps
    public $timestamps = true;

    public function user() {
        return $this->brlongsTo('App\User');
    }
}
