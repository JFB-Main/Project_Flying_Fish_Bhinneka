<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service_typeModel extends Model
{

    protected $table = 'service_type';
    /** The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'service_type_name'
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
    /**
     * Get the service logs for this service type.
     */
    public function serviceLogs()
    {
        return $this->hasMany(Service_logsModel::class, 'service_type');
    }

}
