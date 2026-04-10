<?php namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Service extends Model {
    protected $fillable = ['icon','title','description','order','is_active'];
    protected $casts    = ['is_active' => 'boolean'];
    public function scopeActive($q) { return $q->where('is_active', true)->orderBy('order'); }
}
