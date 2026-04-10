<?php namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model {
    protected $fillable = ['name','email','phone','service','message','is_read'];
    protected $casts    = ['is_read'=>'boolean'];
    public function scopeUnread($q) { return $q->where('is_read',false); }
}
