<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Position extends Model
{     
    use HasFactory; 
    use SoftDeletes;

    protected $fillable = ['position_name', 'reports_to_id']; 

    /*
     * Get the user associated with the Position
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function reports_to ()
    {
        return $this->hasOne(Position::class, 'id', 'reports_to_id');
    }

    public function supervisory () {
        return $this->hasMany(Position::class, 'reports_to_id', 'id');
    }
}
