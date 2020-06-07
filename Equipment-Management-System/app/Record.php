<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    // Table Name
    protected $table = 'records';
    //Primary Key
    protected $primaryKey = 'record_id';
    // Timestamps
    public $timestamps = true;

    public function user() {
        return $this->brlongsTo('App\Record');
    }
}
