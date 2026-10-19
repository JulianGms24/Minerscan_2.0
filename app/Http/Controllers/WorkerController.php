<?php

namespace App\Http\Controllers;

use App\Models\Worker;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    /**
     * Mostrar el listado de trabajadores.
     */
    public function index()
    {
        $workers = Worker::orderBy('first_name')
            ->orderBy('last_name')
            ->get();

        return view('workers.index', compact('workers'));
    }

    /**
     * Mostrar el formulario para registrar un trabajador.
     */
    public function create()
    {
        return view('workers.create');
    }

    /**
     * Guardar un nuevo trabajador.
     */
    public function store(Request $request)
    {
            $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'role' => ['required', 'string', 'max:100'],
            'shift' => ['required', 'string', 'max:100'],
            'document_number' => ['required', 'string', 'max:50', 'unique:workers,document_number'],
            'phone' => ['nullable', 'string', 'max:20'],
            'eps' => ['nullable', 'string', 'max:100'],
            'arl' => ['nullable', 'string', 'max:100'],
            'emergency_contact_name' => ['nullable', 'string', 'max:150'],
            'emergency_contact_phone' => ['nullable', 'string', 'max:20'],
        ],[
            'first_name.required' => 'El nombre es obligatorio.',
            'last_name.required' => 'El apellido es obligatorio.',
            'role.required' => 'El rol del trabajador es obligatorio.',
            'shift.required' => 'El turno del trabajador es obligatorio.',
            'document_number.required' => 'El número de documento es obligatorio.',
            'document_number.unique' => 'Este número de documento ya está registrado.',
        ]);

        $validated['is_active'] = true;

        Worker::create($validated);

        return redirect()
            ->route('workers.index')
            ->with('success', 'Trabajador registrado correctamente.');
    }
}