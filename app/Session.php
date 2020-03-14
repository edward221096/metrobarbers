<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $table = "sessions";
    public $timestamps = "false";
    protected $fillable = [
        'id', 'user_id', 'service_id', 'employee_id', 'start_time', 'end_time', 'paid_amount', 'change_amount', 'sales'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function service(){
        return $this->belongsTo('App\Service');
    }

    public function employee(){
        return $this->belongsTo('App\Employee');
    }

    /**
     * @inheritDoc
     */
    public function getQueueableRelations()
    {
        // TODO: Implement getQueueableRelations() method.
    }
}
