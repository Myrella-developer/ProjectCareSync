<?php

namespace Database\Seeders;

use App\Models\Workout;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkoutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $workout = new Workout();
        $workout->name = 'Yoga';
        $workout->description = 'El yoga combina posturas, respiración y meditación para mejorar flexibilidad, fuerza y bienestar mental. Reduce el estrés y es adecuado para todas las edades.';
        $workout->durationTime = '45';
        $workout->user_id = User::find(1)->id;
        $workout->save();

    }
}
