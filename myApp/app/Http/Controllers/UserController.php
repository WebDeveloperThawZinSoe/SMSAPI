<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\Count;
use App\Models\Log; 
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'roles'    => 'required|array',
            'roles.*'  => 'exists:roles,name',
        ]);

        // Generate unique API key
        do {
            $apiKey = Str::random(40);
        } while (User::where('api_key', $apiKey)->exists());

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'api_key'  => $apiKey,
        ]);

        $user->syncRoles($request->roles);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $userRoles = $user->roles->pluck('name')->toArray();
        return view('admin.users.edit', compact('user', 'roles', 'userRoles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'roles'    => 'required|array',
            'roles.*'  => 'exists:roles,name',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Optionally regenerate API key on update (comment or remove if not needed)
        do {
            $apiKey = Str::random(40);
        } while (User::where('api_key', $apiKey)->where('id', '!=', $user->id)->exists());

        $user->api_key = $apiKey;

        $user->save();

        $user->syncRoles($request->roles);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        if (auth()->id() == $user->id) {
            return redirect()->route('users.index')->with('error', 'You cannot delete yourself.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    public function changePassword()
    {
        return view('auth.change-password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Password changed successfully.');
    }

    public function regenerateApiKey(Request $request)
    {
        $user = Auth::user();

        do {
            $apiKey = Str::random(40);
        } while (\App\Models\User::where('api_key', $apiKey)->exists());

        $user->api_key = $apiKey;
        $user->save();

        return back()->with('api_success', 'API Key regenerated successfully.');
    }

    
    public function userIndex()
    {
        $user_id = Auth::id();

        $totalSMS = Order::where('status', 'completed')->where('user_id', $user_id)
            ->sum('total_sms');

        $totalSmsCount = Count::where("user_id", $user_id)->sum('count');

        $remain = $totalSMS - $totalSmsCount;

        $todaySmsCount = Log::where("user_id", $user_id)->whereDate('created_at', Carbon::today())->count();

        return view('user.dashboard', compact(
            'totalSmsCount',
            'todaySmsCount',
            'remain'
        ));
    }
    

    public function api()
    {
        return view('user.api');
    }

    public function help()
    {
        return view('user.help');
    }


    public function price()
    {
        return view('user.price');
    }

 
}
