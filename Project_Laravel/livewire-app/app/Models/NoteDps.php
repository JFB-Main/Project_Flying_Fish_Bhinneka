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

    // 🚨 NEW ACCESSOR METHOD (PHP 8.1+ syntax) 🚨
    protected function noteContentHtml(): \Illuminate\Database\Eloquent\Casts\Attribute
    {
        return \Illuminate\Database\Eloquent\Casts\Attribute::make(
            get: function (?string $value, array $attributes) {
                // If the content is NULL or empty, return a placeholder or empty string
                $content = $attributes['note_content'];
                if (is_null($content) || trim($content) === '') {
                    return '<p class="text-gray-500 italic">Catatan tidak tersedia.</p>';
                }

                // --- Processing Logic for Non-Null Content ---

                // 1. Separate the notes by the common list separator (" - ")
                $listItems = explode(' - ', $content);

                $htmlList = '';
                $header = array_shift($listItems); // Takes the first element out (the summary line)

                // 2. Start with the main header/summary line
                $htmlList .= '<p>' . nl2br(e($header)) . '</p>';

                if (!empty($listItems)) {
                    // 3. Create an unordered list (<ul>) for the rest of the items
                    $htmlList .= '<ul>';
                    foreach ($listItems as $item) {
                        // Ensure each item is properly escaped and wrap in <li>
                        $htmlList .= '<li>- ' . nl2br(e($item)) . '</li>';
                    }
                    $htmlList .= '</ul>';
                }

                return $htmlList;
            },
        );
    }

    public function serviceLog_dps(): BelongsTo
    {
        return $this->belongsTo(ServiceLogDps::class, 'id_service_logs_dps');
    }

    public function teknisi_dps(): BelongsTo
    {
        return $this->belongsTo(UsersModel::class, 'id_teknisi');
    }
}