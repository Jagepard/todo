<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Item extends Model
{
    use HasFactory;
    use \Conner\Tagging\Taggable;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeSearch($query, Request $request, $userId)
    {
        return $query->where('text', 'LIKE', "%{$request->search}%")
            ->where('user_id', '=', $userId)
            ->get();
    }
}
