<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['author', 'campaign_category'];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function campaign_category()
    {
        return $this->belongsToMany(Category::class, 'campaign_category', 'campaign_id', 'category_id');
    }
}
