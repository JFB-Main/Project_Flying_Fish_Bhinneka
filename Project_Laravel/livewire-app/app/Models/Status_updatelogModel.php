<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status_updatelogModel extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'status_updatelog';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'service_logs_id',
        'status_id',
        'teknisi_id',
        'status_note'
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime'
    ];
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    /**
     * Get the service log associated with this update log.
     */
    public function serviceLog()
    {
        return $this->belongsTo(Service_logsModel::class, 'service_logs_id', 'techlog_id');
    }
    
    /**
     * Get the status associated with this update log.
     */
    public function status()
    {
        return $this->belongsTo(StatusModel::class, 'status_id');
    }
    /**
     * Get the technician associated with this update log.
     */
    public function technician()
    {
        return $this->belongsTo(UsersModel::class, 'teknisi_id');
    }
}
