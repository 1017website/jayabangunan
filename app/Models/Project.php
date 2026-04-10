<?php namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Project extends Model {
    protected $fillable = ['title','category','location','year','image','description','order','is_featured','is_active'];
    protected $casts    = ['is_active'=>'boolean','is_featured'=>'boolean'];
    public function scopeActive($q) { return $q->where('is_active', true)->orderBy('order'); }
    public function scopeFeatured($q) { return $q->where('is_featured', true); }
    public function getImageUrlAttribute(): string {
        if (!$this->image) return 'https://images.unsplash.com/photo-1486325212027-8081e485255e?w=800&q=80';
        if (str_starts_with($this->image, 'http')) return $this->image;
        return asset('storage/' . $this->image);
    }
}
