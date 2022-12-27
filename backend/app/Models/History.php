<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $table ='histories';

    protected $fillable = [       
        'module',
        'operation',
        'user_id',
    ];

    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->setTimezone('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFilterHistory($query, $filters)
    {
        return $query
        ->when(isset($filters['sortModule']), function ($q) use ($filters){
                return $q->orderBy('module', $filters['sortModule']);        
        })
        ->when(isset($filters['sortOperation']), function ($q) use ($filters){
            return $q->orderBy('operation', $filters['sortOperation']); 
        })
        ->when(isset($filters['sortCreateDate']), function ($q) use ($filters){
            return $q->orderBy('created_at', $filters['sortCreateDate']);       
        })
        ->when(isset($filters['sortUser']), function ($q) use ($filters){
            return $q->orderBy('name', $filters['sortUser']);       
        });
    }
}
