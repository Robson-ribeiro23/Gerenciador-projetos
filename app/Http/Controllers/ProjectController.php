<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    // LISTAR (GET)
    public function index()
    {
        // Traz os projetos com os dados do dono (owner)
        $projects = Project::with('owner')->get();
        return response()->json($projects);
    }

    // CRIAR (POST)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $project = Project::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'owner_id' => Auth::id(), // Pega o ID do usuário logado automaticamente
        ]);

        return response()->json($project, 201);
    }
}