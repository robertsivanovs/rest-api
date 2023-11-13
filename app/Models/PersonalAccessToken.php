<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalAccessToken extends Model
{
    use HasFactory;

    // Assign database table
    protected $table = 'personal_access_tokens';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'token',
        'tokenable_id'
    ];
    
    /**
     * user
     * 
     * tokenable_id in the personal_access_tokens table
     * represents user_id
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'tokenable_id');
    }

}
