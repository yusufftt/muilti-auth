<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:show-mahasiswa|create-mahasiswa|edit-mahasiswa|delete-mahasiswa', ['only' => ['index', 'show']]);
        $this->middleware('permission:create-mahasiswa', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-mahasiswa', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-mahasiswa', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {   
        // dd(User::get());
        // dd(User::latest('id')->where('type',3)->paginate(3)[0]->id);
        return view('mahasiswas.index', [
            'mahasiswas' => User::latest('id')->where('type',3)->paginate(3)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        // return view('mahasiswas.create', [
        //     'roles' => Role::pluck('name')->all()
        // ]);
        return view('mahasiswas.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $input = $request->validate([
            'name' => 'required|string|max:250',
            // 'email' => 'required|string|email:rfc,dns|max:250|unique:users,email',
            'email' => ["required","string","regex:/(.+)@(.+)\.(.+)/i","unique:users,email"],
            'password' => 'nullable|string|confirmed',
            'jurusan' => 'required|string',            
            'semester' => 'required'            
        ]);
        $input['password'] = Hash::make($request->password);
        $input['type'] = 3; // type user mahasiswa
        // dd($input);
        $user = User::create($input);
        $user->assignRole("Mahasiswa");
        return redirect()->route('mahasiswas.index')
            ->withSuccess('New Mahasiswa is added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user, $id): View
    {   
        // dd($id);
        // dd(User::where('id',$id)->get()[0]);
        // dd(User::);
        return view('mahasiswas.show', [
            'mahasiswa' => User::where('id',$id)->get()[0]
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $mahasiswa = User::where('id',$id)->get()[0];
        // Check Only Super Admin can update his own Profile
        if ($mahasiswa->hasRole('Super Admin') && $mahasiswa->id != auth()->user()->id) {
                abort(403, 'USER DOES NOT HAVE THE RIGHT PERMISSIONS');
        }
        return view('mahasiswas.edit', [
            'mahasiswa' => User::where('id',$id)->get()[0],
            'roles' => Role::pluck('name')->all(),
            'userRoles' => $mahasiswa->roles->pluck('name')->all()
        ]);

    }

    public function update(Request $request, $id): RedirectResponse
    {

        // dd($request->except('password'));
        $validated = $request->validate([
            'name' => 'required|string|max:250',
            // 'email' => 'required|string|email:rfc,dns|max:250|unique:users,email,'.User::where('id',$id)->value('id'),
            // 'email' => 'required|string|email:rfc,dns|max:250|unique:users,email,'.User::where('id',$id)->value('id').',id',
            'email' => ["required","string","regex:/(.+)@(.+)\.(.+)/i","unique:users,email,".User::where('id',$id)->value('id').",id"],
            'password' => 'nullable|string|confirmed',
            'jurusan' => 'required|string',            
            'semester' => 'required'            
        ]);
        $validated['roles'] = 'Mahasiswa';
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } 
        else {
            $validated['password'] = User::where('id',$id)->get()[0]['password'];
        }
        // dd($validated);
        User::where('id',$id)->get()[0]->update($validated);
        // User::where('id',$id)->get()[0]->syncRoles($request->roles);
        return redirect()->back()
            ->withSuccess('Mahasiswa is updated successfully.');
    }

    public function destroy($id): RedirectResponse
    {
        $mahasiswa = User::where('id',$id)->get()[0];
        if ($mahasiswa->hasRole('Super Admin') || $mahasiswa->id == auth()->user()->id) {
            abort(403, 'USER DOES NOT HAVE THE RIGHT PERMISSIONS');
        }
        $mahasiswa->syncRoles([]);
        $mahasiswa->delete();
        return redirect()->route('mahasiswas.index')
            ->withSuccess('Mahasiswa is deleted successfully.');

    }
}
