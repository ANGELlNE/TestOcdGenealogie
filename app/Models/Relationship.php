<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Relationship extends Model
{
    protected $fillable = ['created_by','parent_id','child_id'];

    public function children() {
        return $this->belongsTo(Person::class, 'child_id');
    }

    public function parents() {
        return $this->belongsTo(Person::class, 'parent_id');
    }   
    
    public function creator() {
        return $this->belongsTo(Person::class, 'created_by');
    }
    
}
