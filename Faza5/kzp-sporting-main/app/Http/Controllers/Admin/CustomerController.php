<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Customer\CreateRequest;
use App\Http\Requests\Admin\Customer\UpdateRequest;
use App\Models\Customer;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        return view('admin.pages.customer.index', [
            'list' => Customer::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.pages.customer.show');
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
            Customer::create([
                'user_id' => $user->id,
                'date_of_birth' => $request->get('date_of_birth'),
                'email' => $request->get('email'),
                'contact' => $request->get('contact'),
                'is_active' => $request->get('is_active'),
                'date_register' => now(),
            ]);

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();

            return back()->withErrors('Unsuccessfully to create customer!');
        }

        return redirect()->route('admin.customers.index')->with(['success' => 'Successfully to created customer!']);
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
     * @param Customer $customer
     * @return Application|Factory|View
     */
    public function edit(Customer $customer)
    {
        return view('admin.pages.customer.show', ['item' => $customer]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Customer $customer
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, Customer $customer): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $dataUser = [
                'username' => $request->get('username'),
                'password' => $request->get('password'),
                'name' => $request->get('name'),
                'surname' => $request->get('surname'),
            ];
            $dataCustomer = [
                'date_of_birth' => $request->get('date_of_birth'),
                'email' => $request->get('email'),
                'contact' => $request->get('contact'),
                'is_active' => $request->get('is_active'),
            ];

            if (!$request->password) {
                unset($dataUser['password']);
            }

            $customer->user->update($dataUser);
            $customer->update($dataCustomer);

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();

            return back()->withErrors('Unsuccessfully to update customer!');
        }

        return redirect()->route('admin.customers.index')->with(['success' => 'Successfully to updated customer!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Customer $customer
     * @return RedirectResponse
     */
    public function destroy(Customer $customer): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $user = User::find($customer->user_id);
            $customer->delete();
            $user->delete();

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();

            return back()->withErrors('Unsuccessfully to delete customer!');
        }

        return back()->with(['success' => 'Successfully to deleted customer!']);
    }
}
