<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class LongTermProgram extends Model {
    protected $table = 'long_term_programs';
    protected $fillable = ['name', 'code', 'description'];

    public function subjects() { 
        return $this->hasMany(Subject::class, 'long_term_program_id'); 
    }
}