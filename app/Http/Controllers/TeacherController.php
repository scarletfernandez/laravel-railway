<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::all();

        return response()->json([
            'teachers' => $teachers,
            'status' => 200
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'grade' => 'required|numeric|min:0|max:100',
            'specialist' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $teacher = Teacher::create([
            'name' => $request->name,
            'grade' => $request->grade,
            'specialist' => $request->specialist
        ]);

        if (!$teacher) {
            return response()->json([
                'message' => 'Error al crear el maestro',
                'status' => 500
            ]);
        }

        return response()->json([
            'teacher' => $teacher,
            'status' => 201
        ], 201);
    }

    public function show($id)
    {
        $teacher = Teacher::find($id);

        if (!$teacher) {
            return response()->json([
                'message' => 'Maestro no encontrado',
                'status' => 404
            ]);
        }

        return response()->json([
            'teacher' => $teacher,
            'status' => 200
        ]);
    }

    public function destroy($id)
    {
        $teacher = Teacher::find($id);

        if (!$teacher) {
            return response()->json([
                'message' => 'Maestro no encontrado',
                'status' => 404
            ]);
        }

        $teacher->delete();

        return response()->json([
            'message' => 'Maestro eliminado',
            'status' => 200
        ]);
    }

    public function update(Request $request, $id)
    {
        $teacher = Teacher::find($id);

        if (!$teacher) {
            return response()->json([
                'message' => 'Maestro no encontrado',
                'status' => 404
            ]);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'grade' => 'required|numeric|min:0|max:100',
            'specialist' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación',
                'errors' => $validator->errors(),
                'status' => 400
            ]);
        }

        $teacher->name = $request->name;
        $teacher->grade = $request->grade;
        $teacher->specialist = $request->specialist;

        $teacher->save();

        return response()->json([
            'message' => 'Maestro actualizado',
            'teacher' => $teacher,
            'status' => 200
        ]);
    }

    public function updatePartial(Request $request, $id)
    {
        $teacher = Teacher::find($id);

        if (!$teacher) {
            return response()->json([
                'message' => 'Maestro no encontrado',
                'status' => 404
            ]);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'max:255',
            'grade' => 'numeric|min:0|max:100',
            'specialist' => 'max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación',
                'errors' => $validator->errors(),
                'status' => 400
            ]);
        }

        if ($request->has('name')) {
            $teacher->name = $request->name;
        }

        if ($request->has('grade')) {
            $teacher->grade = $request->grade;
        }

        if ($request->has('specialist')) {
            $teacher->specialist = $request->specialist;
        }

        $teacher->save();

        return response()->json([
            'message' => 'Maestro actualizado parcialmente',
            'teacher' => $teacher,
            'status' => 200
        ]);
    }
}