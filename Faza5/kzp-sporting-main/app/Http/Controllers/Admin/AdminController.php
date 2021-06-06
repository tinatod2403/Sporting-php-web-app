<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Admin\CreateRequest;
use App\Http\Requests\Admin\Admin\UpdateRequest;
use App\Models\Admin;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        return view('admin.pages.admin.index', [
            'list' => Admin::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.pages.admin.show');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateRequest $request
     * @return RedirectResponse
     */
    public function store(CreateRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $user = User::create($request->all());
            Admin::create(['user_id' => $user->id]);

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();

            return back()->withErrors('Unsuccessfully to create admin!');
        }

        return redirect()->route('admin.admins.index')->with(['success' => 'Successfully to created admin!']);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show(int $id): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Admin $admin
     * @return Application|Factory|View
     */
    public function edit(Admin $admin)
    {
        return view('admin.pages.admin.show', ['item' => $admin]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Admin $admin
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, Admin $admin): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $data = $request->all();

            if (!$request->password) {
                unset($data['password']);
            }

            $admin->user->update($data);

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();

            return back()->withErrors('Unsuccessfully to update admin!');
        }

        return redirect()->route('admin.admins.index')->with(['success' => 'Successfully to updated admin!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Admin $admin
     * @return RedirectResponse
     */
    public function destroy(Admin $admin): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $user = User::find($admin->user_id);
            $admin->delete();
            $user->delete();

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();

            return back()->withErrors('Unsuccessfully to delete admin!');
        }

        return back()->with(['success' => 'Successfully to deleted admin!']);
    }
}
