<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class EstudianteController extends Controller
{
    public function index(Request $request)
    {
        $query = Estudiante::query();

        if ($request->has('nombre')) {
            $query->where('nombre', 'like', '%' . $request->nombre . '%');
        }

        if ($request->has('apellido')) {
            $query->where('apellido', 'like', '%' . $request->apellido . '%');
        }
        $estudiantes = $query->orderBy('id', 'desc')->simplePaginate(10);

        return view('estudiantes.index', compact('estudiantes'));
    }

    public function create()
    {
        return view('estudiantes.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|unique:estudiantes,email',
            'pin' => 'required|numeric|digits_between:4,6',
        ]);

        $validatedData['pin'] = Hash::make($validatedData['pin']);
        Estudiante::create($validatedData);

        return redirect()->route('estudiantes.index')->with('success', 'Estudiante registrado correctamente.');
    }

    public function show($id)
    {
        $estudiante = Estudiante::find($id);

        if (!$estudiante) {
            return abort(404);
        }

        return view('estudiantes.show', compact('estudiante'));
    }

    public function edit($id)
    {
        $estudiante = Estudiante::find($id);

        if (!$estudiante) {
            return abort(404);
        }
        return view('estudiantes.edit', compact('estudiante'));
    }

    public function update(Request $request, $id)
    {
        $estudiante = Estudiante::find($id);

        if (!$estudiante) {
            return abort(404);
        }

        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|unique:estudiantes,email,' . $estudiante->id,
        ]);

        if ($request->filled('pin')) {
            $validatedData['pin'] = Hash::make($request->pin);
        }

        $estudiante->update($validatedData);

        return redirect()->route('estudiantes.index')->with('success', 'Estudiante actualizado correctamente.');
    }

    public function delete($id)
    {
        $estudiante = Estudiante::find($id);

        if (!$estudiante) {
            return abort(404);
        }
        return view('estudiantes.delete', compact('estudiante'));
    }

    public function destroy($id)
    {
        $estudiante = Estudiante::find($id);

        if (!$estudiante) {
            return abort(404);
        }

        $estudiante->delete();

        return redirect()->route('estudiantes.index')->with('success', 'Estudiante eliminado correctamente.');
    }

    public function showLoginForm()
    {
        return view('estudiantes.login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' =>'required|email',
            'pin' => 'required'
        ]);

        // Buscar al estudiante por correo electrónico
        $estudiante = Estudiante::where('email', $request['email'])->first();

        // Verificar si el estudiante existe y la contraseña es válida
        if ($estudiante && Hash::check($request['pin'], $estudiante->pin)) {
            Auth::guard('estudiante')->login($estudiante);
            return redirect()->route('estudiantes.index'); // Redirigir a la lista de estudiantes
        } else {
            // Mostrar mensaje de error si las credenciales no coinciden
            return redirect()->back()->withErrors([
                'InvalidCredentials' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
            ]);
        }
    }




    public function logout()
    {
        Auth::guard('estudiante')->logout();
        return redirect()->route('estudiantes.showLoginForm');
    }
}
