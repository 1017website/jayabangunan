<?php namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model {
    protected $fillable = ['name','role','company','content','rating','avatar','order','is_active'];
    protected $casts    = ['is_active'=>'boolean'];
    public function scopeActive($q) { return $q->where('is_active',true)->orderBy('order'); }
    public function getAvatarUrlAttribute(): string {
        if (!$this->avatar) return 'https://ui-avatars.com/api/?name='.urlencode($this->name).'&background=8B0000&color=fff';
        if (str_starts_with($this->avatar,'http')) return $this->avatar;
        return asset('storage/'.$this->avatar);
    }
    public function getStarsAttribute(): string { return str_repeat('★',$this->rating).str_repeat('☆',5-$this->rating); }
}
