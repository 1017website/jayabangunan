<?php namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Stat extends Model {
    protected $fillable = ['value','suffix','label','icon','order','is_active'];
    protected $casts    = ['is_active'=>'boolean'];
    public function scopeActive($q) { return $q->where('is_active',true)->orderBy('order'); }
}
