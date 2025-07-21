<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service_logsModel extends Model
{
    use HasFactory;
        /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'service_logs';

    protected $fillable = [
        'techlog_id',
        'date_in',
        'received_from',
        'alamat',
        'mobile_number',
        'email',
        'contact_person',
        'serial_number',
        'part_number',
        'SKU',
        'brand_type',
        'description_product',
        'problem',
        'pre_diagnostic',
        'add_on',
        'sales_order',
        'invoice_date',
        'warranty_status',
        'create_by',
        'service_type',
        'status_id',
        'part_ready',
        'completed_date',
        'return_date',
    ];

    // Define relationships
    public function user()
    {
        return $this->belongsTo(UsersModel::class, 'create_by');
    }
    public function serviceId()
    {
        return $this->belongsTo(Service_typeModel::class, 'service_type');
    }
    public function status()
    {
        return $this->belongsTo(StatusModel::class, 'status_id');
    }

}
