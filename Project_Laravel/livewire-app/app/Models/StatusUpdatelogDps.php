<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class StatusUpdatelogDps extends Model
{
    use HasFactory;

    protected $table = 'status_updatelog_dps';

    // Since your table includes 'created_at' but not 'updated_at' (based on your schema),
    // we need to disable the 'updated_at' timestamp update.
    // const UPDATED_AT = null; 
    
    // Define the columns that can be mass assigned
    protected $fillable = [
        'service_logs_id_dps', 
        'status_id', 
        'status_note',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public $timestamps = false;


    // Define relationships based on your foreign keys

    /**
     * Get the service log entry that this status update belongs to.
     */
    public function serviceLog_dps_fk(): BelongsTo
    {
        // Links service_logs_id_dps (FK) to service_logs_dps.id (PK)
        return $this->belongsTo(ServiceLogDps::class, 'service_logs_id_dps');
    }

    /**
     * Get the specific status that was set.
     */
    public function status_dps_fk(): BelongsTo
    {
        // Links status_id (FK) to status_dps.id (PK)
        return $this->belongsTo(StatusDps::class, 'status_id');
    }
}
