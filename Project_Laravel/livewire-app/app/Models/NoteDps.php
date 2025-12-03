<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NoteDps extends Model
{
    use HasFactory;

    protected $table = 'notes_dps';
    protected $fillable = ['id_service_logs_dps', 'id_teknisi', 'note_content'];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public $timestamps = false;

    public function serviceLog_dps(): BelongsTo
    {
        return $this->belongsTo(ServiceLogDps::class, 'id_service_logs_dps');
    }

    public function teknisi_dps(): BelongsTo
    {
        return $this->belongsTo(UsersModel::class, 'id_teknisi');
    }
}