<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    // Campos que podem ser salvos
    protected $fillable = ['title', 'description', 'owner_id'];

    // Relação: Um projeto pertence a um Dono (User)
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    // Relação: Um projeto tem muitos membros (Users)
    public function users()
    {
        return $this->belongsToMany(User::class, 'project_user')->withPivot('role');
    }

    // Relação: Um projeto tem muitas tarefas
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}