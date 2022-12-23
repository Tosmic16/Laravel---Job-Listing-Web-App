<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Listing extends Model
{
    use HasFactory;

    // protected $fillable = ['title', 'company', 'location', 'website', 'email', 'description',
    // 'tags'];

    public function scopeFilter($query, array $filters){
        //to filter by tags
        if($filters['tag'] ?? false){
            $query->where('tags', 'like', '%'.request('tag').'%');
        }
        //to filter by serrch parameter
        if($filters['search'] ?? false){
            $query->where('tags', 'like', '%'.request('search').'%')
                        ->orwhere('title', 'like', '%'.request('search').'%')
                            ->orwhere('description', 'like', '%'.request('search').'%');
        }
    }
    //relationship to user
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
