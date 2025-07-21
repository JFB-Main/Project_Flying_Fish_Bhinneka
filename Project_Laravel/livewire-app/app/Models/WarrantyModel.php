<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarrantyModel extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'warranty';
    /**
     * The attributes that are mass assignable.
     * Only 'warranty_status' is fillable as id and timestamps are auto-managed
     *
     * @var array*/
    protected $fillable = [
        'warranty_status'
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    /**
     * Indicates if the model should be timestamped.
     * Enabled to match your table structure
     *
     * @var bool
     */
    public $timestamps = true;
    /**
     * Get all service logs with this warranty status
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function serviceLogs()
    {
        return $this->hasMany(Service_logsModel::class, 'warranty_status');
    }

}
