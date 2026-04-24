<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ['title', 'youtube_url', 'description', 'order', 'is_active'];
    protected $casts    = ['is_active' => 'boolean'];

    public function scopeActive($q)
    {
        return $q->where('is_active', true)->orderBy('order');
    }

    // Ambil YouTube Video ID dari berbagai format URL
    public function getYoutubeIdAttribute(): string
    {
        $url = $this->youtube_url;
        preg_match('/(?:youtube\.com\/(?:watch\?v=|shorts\/|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $url, $matches);
        return $matches[1] ?? '';
    }

    // URL embed untuk iframe
    public function getEmbedUrlAttribute(): string
    {
        return 'https://www.youtube.com/embed/' . $this->youtube_id . '?autoplay=1&mute=0&rel=0&playsinline=1';
    }

    // Thumbnail otomatis dari YouTube
    public function getThumbnailUrlAttribute(): string
    {
        $id = $this->youtube_id;
        if (!$id) return '';
        return "https://img.youtube.com/vi/{$id}/maxresdefault.jpg";
    }

    // URL tonton langsung
    public function getWatchUrlAttribute(): string
    {
        return 'https://www.youtube.com/watch?v=' . $this->youtube_id;
    }
}
