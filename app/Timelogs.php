<?php

namespace App;

use App\Http\Controllers\JoinUserTimelogsController;
use Illuminate\Database\Eloquent\Model;

class Timelogs extends Model
{
    protected $table="timelogs";

    public $timestamps = false;

    protected $fillable = [
        'day', 'user_id', 'status', 'timeout'
    ];

    public function customer(){
        return $this->belongsTo('App\Customer');
    }

    /**
     * @inheritDoc
     */
    public function getQueueableRelations()
    {
        // TODO: Implement getQueueableRelations() method.
    }
}
