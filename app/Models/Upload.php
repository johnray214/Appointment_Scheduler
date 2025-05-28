<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'appointment_id',
        'filename',
        'original_filename',
        'mime_type',
        'size',
        'path',
        'description',
    ];

    /**
     * Get the user that owns the upload.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the appointment associated with the upload.
     */
    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    /**
     * Get the formatted file size.
     */
    public function getFormattedSizeAttribute()
    {
        $bytes = $this->size;
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $index = 0;

        while ($bytes >= 1024 && $index < count($units) - 1) {
            $bytes /= 1024;
            $index++;
        }

        return round($bytes, 2) . ' ' . $units[$index];
    }

    /**
     * Get the file type icon.
     */
    public function getFileTypeIconAttribute()
    {
        $extension = strtolower(pathinfo($this->original_filename, PATHINFO_EXTENSION));
        
        return match($extension) {
            'pdf' => 'document-pdf',
            'doc', 'docx' => 'document-text',
            'xls', 'xlsx' => 'table-cells',
            'ppt', 'pptx' => 'presentation-chart-bar',
            'jpg', 'jpeg', 'png', 'gif' => 'photo',
            'zip', 'rar' => 'archive-box',
            default => 'document',
        };
    }

    /**
     * Get the file type category.
     */
    public function getFileTypeCategoryAttribute()
    {
        $extension = strtolower(pathinfo($this->original_filename, PATHINFO_EXTENSION));
        
        return match($extension) {
            'pdf' => 'pdf',
            'doc', 'docx' => 'document',
            'xls', 'xlsx' => 'spreadsheet',
            'ppt', 'pptx' => 'presentation',
            'jpg', 'jpeg', 'png', 'gif' => 'image',
            'zip', 'rar' => 'archive',
            default => 'other',
        };
    }
} 