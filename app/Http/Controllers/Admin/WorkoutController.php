<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Workout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class WorkoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Verifica si el usuario tiene permiso para gestionar workouts
        if (Gate::denies('manage-workouts')) {
            return redirect('/')->with('error', 'No tienes permiso para ver esta página.');
        }

        $workouts = Workout::all(); // Obtiene todos los workouts
        return view('admin.workouts.index', compact('workouts')); // Muestra la vista de listado
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Verifica si el usuario tiene permiso para gestionar workouts
        if (Gate::denies('manage-workouts')) {
            return redirect('/')->with('error', 'No tienes permiso para ver esta página.');
        }

        return view('admin.workouts.create'); // Muestra el formulario para crear un workout
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Verifica si el usuario tiene permiso para gestionar workouts
        if (Gate::denies('manage-workouts')) {
            return redirect('/')->with('error', 'No tienes permiso para realizar esta acción.');
        }

        // Valida los datos del formulario
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'durationTime' => 'required|numeric',
        ]);

        // Crea un nuevo workout
        Workout::create($request->all());

        // Redirige a la lista de workouts
        return redirect()->route('admin.workouts.index')->with('success', 'Workout creado con éxito.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Workout $workout)
    {
        // Verifica si el usuario tiene permiso para gestionar workouts
        if (Gate::denies('manage-workouts')) {
            return redirect('/')->with('error', 'No tienes permiso para ver esta página.');
        }

        return view('admin.workouts.edit', compact('workout')); // Muestra el formulario de edición
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Workout $workout)
    {
        // Verifica si el usuario tiene permiso para gestionar workouts
        if (Gate::denies('manage-workouts')) {
            return redirect('/')->with('error', 'No tienes permiso para realizar esta acción.');
        }

        // Valida los datos del formulario
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'durationTime' => 'required|numeric',
        ]);

        // Actualiza el workout
        $workout->update($request->all());

        // Redirige a la lista de workouts
        return redirect()->route('admin.workouts.index')->with('success', 'Workout actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Workout $workout)
    {
        // Verifica si el usuario tiene permiso para gestionar workouts
        if (Gate::denies('manage-workouts')) {
            return redirect('/')->with('error', 'No tienes permiso para realizar esta acción.');
        }

        // Elimina el workout
        $workout->delete();

        // Redirige a la lista de workouts
        return redirect()->route('admin.workouts.index')->with('success', 'Workout eliminado con éxito.');
    }
}
