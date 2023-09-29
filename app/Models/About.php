<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

    protected $fillable = [ 'company_history', 'founder_message' , 'mission_statement' , 'community_involvement' , 'social_media_links' ];
}
