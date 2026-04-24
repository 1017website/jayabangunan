<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ['title', 'file_path', 'thumbnail', 'description', 'order', 'is_active'];
    protected $casts = ['is_active' => 'boolean'];

    public function scopeActive($q)
    {
        return $q->where('is_active', true)->orderBy('order');
    }

    public function getVideoUrlAttribute(): string
    {
        if (str_starts_with($this->file_path, 'http'))
            return $this->file_path;
        return asset('storage/' . $this->file_path);
    }

    public function getThumbnailUrlAttribute(): ?string
    {
        if (!$this->thumbnail)
            return null;
        if (str_starts_with($this->thumbnail, 'http'))
            return $this->thumbnail;
        return asset('storage/' . $this->thumbnail);
    }
}