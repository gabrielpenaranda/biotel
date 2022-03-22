<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    use HasFactory;

    protected $table = 'checklists';

    protected $fillable = ['name', 'description', 'definition_date', 'version', 'is_active', 'instructions'];

    public function elements() {
        return $this->hasMany(Element::class);
    }

}
