<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $table = 'logs';

    protected $fillable = ['description', 'action', 'table', 'table_id', 'user_id'];

    // ***************************************************************************************
    public function register($logs, $action, $description, $table_id, $table, $user_id)
    {
        switch ($action) {
            case 'C':
                $desc = "Create record: " . $description;
                break;
            case 'D':
                $desc = "Delete record: " . $description;
                break;
            case 'U':
                $desc = "Update record: " . $description;
                break;
        }
        $logs->description = $desc;
        $logs->action = $action;
        $logs->table = $table;
        $logs->table_id = $table_id;
        $logs->user_id = $user_id;
        $logs->save();
    }

    // ***************************************************************************************

    public function users()
    {
        return $this->hasMany(User::class);
    }
    
}
