<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
    	'first_name',
    	'last_name',
    	'phone',
    	'email',
    	'address',
    	'photo'
    ];

    protected $appends = [
        'photo_url',
    ];

    public function getPhotoUrlAttribute()
    {
        return $this->photo
                    ? Storage::url($this->photo)
                    : 'https://ui-avatars.com/api/?name='.urlencode($this->first_name . ' ' . $this->last_name).'&color=7F9CF5&background=EBF4FF';
    }

    public function scopeSearch($query, $search)
    {
        return $query
        	->where('first_name', 'like', "%{$search}%")
        	->orWhere('last_name', 'like', "%{$search}%")
        	->orWhere('phone', 'like', "%{$search}%")
        	->orWhere('email', 'like', "%{$search}%")
        	->orWhere('address', 'like', "%{$search}%");
    }
}
