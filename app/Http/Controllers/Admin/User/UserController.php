<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\User;
use App\Utils\ImageManger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sort_by = request()->sort ?? 'id';
        $order_by = request()->order_by ?? 'desc';
        $limit_by = request()->limit_by ?? 5;

        $users = User::when(request()->keyword, function ($query) {
            $query->where('name', 'LIKE', '%' . request()->keyword . '%')
                ->orWhere('email', 'LIKE', '%' . request()->keyword . '%');
        })
            ->when(!is_null(request()->status), function ($query) {
                $query->where('status', request()->status);
            })
            ->orderBy($sort_by, $order_by)
            ->paginate($limit_by);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $request->validated();
        try {
            DB::beginTransaction();
            $request->merge([
                'password' => Hash::make($request->password),
                'email_verified_at' => (int)$request->email_verified_at === 1 ? now() : null,
            ]);
            $user = User::create($request->except(['_token', 'password_confirmation', 'image']));
            ImageManger::uploadImages($request, null, $user);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong ' . $e->getMessage());
        }
        return redirect()->back()->with('success', 'User Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $userImage = $user->image;
        if (File::exists(public_path($userImage))) {
            File::delete(public_path($userImage));
        }
        $user->delete();
        return redirect()->route('admin.user.index')->with('success', 'User Deleted Successfully');
    }

    public function changeStatus(string $id)
    {
        $user = User::findOrFail($id);
        $user->status = !$user->status;
        $user->save();
        return redirect()->back()->with('success', 'User Status Updated Successfully');
    }
}
