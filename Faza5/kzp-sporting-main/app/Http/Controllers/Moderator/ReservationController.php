<?php

namespace App\Http\Controllers\Moderator;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        return view('moderator.pages.reservation.index', [
            'list' => Reservation::paginate(10)
        ]);
    }

    /**
     * @param Request $request
     * @param Reservation $reservation
     * @return RedirectResponse
     */
    public function update(Request $request, Reservation $reservation): RedirectResponse
    {
        try {
            $reservation->update(['status' => $request->get('status')]);

        } catch (Exception $exception) {
            return back()->withErrors('Unsuccessfully to update reservation!');
        }

        return back()->with(['success' => 'Successfully to updated reservation!']);
    }
}
