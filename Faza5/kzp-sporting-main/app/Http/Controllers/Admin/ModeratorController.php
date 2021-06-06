<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Moderator\CreateRequest;
use App\Http\Requests\Admin\Moderator\UpdateRequest;
use App\Models\Complex;
use App\Models\Moderator;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ModeratorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        return view('admin.pages.moderator.index', [
            'list' => Moderator::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.pages.moderator.show');
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

            $user = User::create([
                'username' => $request->get('username'),
                'password' => $request->get('password'),
                'name' => $request->get('name'),
                'surname' => $request->get('surname'),
            ]);
            $moderator = Moderator::create([
                'user_id' => $user->id,
                'date_of_birth' => $request->get('date_of_birth'),
                'email' => $request->get('email'),
                'contact' => $request->get('contact'),
                'date_register' => now(),
            ]);
            Complex::create(['moderator_id' => $moderator->id]);

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();

            return back()->withErrors('Unsuccessfully to create moderator!');
        }

        return redirect()->route('admin.moderators.index')->with(['success' => 'Successfully to created moderator!']);
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
     * @param Moderator $moderator
     * @return Application|Factory|View
     */
    public function edit(Moderator $moderator)
    {
        return view('admin.pages.moderator.show', ['item' => $moderator]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Moderator $moderator
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, Moderator $moderator): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $dataUser = [
                'username' => $request->get('username'),
                'password' => $request->get('password'),
                'name' => $request->get('name'),
                'surname' => $request->get('surname'),
            ];
            $dataModerator = [
                'date_of_birth' => $request->get('date_of_birth'),
                'email' => $request->get('email'),
                'contact' => $request->get('contact'),
            ];

            if (!$request->password) {
                unset($dataUser['password']);
            }

            $moderator->user->update($dataUser);
            $moderator->update($dataModerator);

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();

            return back()->withErrors('Unsuccessfully to update moderator!');
        }

        return redirect()->route('admin.moderators.index')->with(['success' => 'Successfully to updated moderator!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Moderator $moderator
     * @return RedirectResponse
     */
    public function destroy(Moderator $moderator): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $user = User::find($moderator->user_id);
            $moderator->delete();
            $user->delete();

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();

            return back()->withErrors('Unsuccessfully to delete moderator!');
        }

        return back()->with(['success' => 'Successfully to deleted moderator!']);
    }
}
