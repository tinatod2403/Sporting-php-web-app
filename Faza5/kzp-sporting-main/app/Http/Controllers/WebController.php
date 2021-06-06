<?php

namespace App\Http\Controllers;

use App\Http\Requests\Web\LoginRequest;
use App\Http\Requests\Web\RegisterRequest;
use App\Models\Appointment;
use App\Models\Category;
use App\Models\Complex;
use App\Models\Court;
use App\Models\Customer;
use App\Models\News;
use App\Models\Reservation;
use App\Models\User;
use App\Models\WorkingHour;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('web.home', [
            'news' => News::where('type', 'news')->orderBy('created_at', 'desc')->limit(3)->get(),
            'promotions' => News::where('type', 'promotions')->orderBy('created_at', 'desc')->limit(3)->get(),
        ]);
    }

    public function registerPage()
    {
        return view('web.register');
    }

    /**
     * @param RegisterRequest $request
     * @return RedirectResponse
     */
    public function register(RegisterRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $user = User::create([
                'username' => $request->get('username'),
                'password' => $request->get('password'),
                'name' => $request->get('first_name'),
                'surname' => $request->get('last_name'),
            ]);
            Customer::create([
                'user_id' => $user->id,
                'date_of_birth' => date('d.m.Y.', strtotime("{$request->get('day')}.{$request->get('month')}.{$request->get('year')}.")),
                'email' => $request->get('email'),
                'contact' => $request->get('contact'),
                'date_register' => now(),
            ]);

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();

            return back()->withErrors('Korisnik nije uspesno registrovan!');
        }

        return redirect()->route('home')->with(['success' => 'Uspesno ste se registrovali!']);
    }

    /**
     * @param News $news
     * @return Application|Factory|View
     */
    public function news(News $news)
    {
        return view('web.news', ['news' => $news]);
    }

    /**
     * @return Application|Factory|View
     */
    public function aboutUs()
    {
        return view('web.about-us');
    }

    /**
     * @return Application|Factory|View
     */
    public function category($category)
    {
        $category = Category::where('type', $category)->firstOrFail();
        return view('web.category', [
            'category' => $category
        ]);
    }

    /**
     * @return Application|Factory|View
     */
    public function complex($category, $complex)
    {
        $category = Category::where('type', $category)->firstOrFail();
        $complex = Complex::where('name', $complex)->firstOrFail();

        return view('web.complex', [
            'category' => $category,
            'complex' => $complex
        ]);
    }

    /**
     * @return Application|Factory|View
     */
    public function calendar($category, $complex)
    {
        $category = Category::where('type', $category)->firstOrFail();
        $complex = Complex::where('name', $complex)->firstOrFail();

        return view('web.calendar', [
            'category' => $category,
            'complex' => $complex
        ]);
    }

    /**
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        auth()->attempt(['username' => $request->username, 'password' => $request->password]);
        auth()->guard('customer')->loginUsingId(auth()->user()->customer->id);
        auth()->logout();
        if (!auth()->guard('customer')->user()->is_active) {
            auth()->guard('customer')->logout();

            return back()->withErrors("Ne postoji korisnik sa tim podacima!");
        }

        if (auth()->guard('customer')->check()) {
            return redirect()->route('home');
        }

        return back()->withErrors("Ne postoji korisnik sa tim podacima!");
    }

    /**
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        auth()->guard('customer')->logout();

        return redirect()->route('home');
    }

    /**
     * @return Application|Factory|View
     */
    public function myProfile()
    {
        return view('web.my-profile');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function addRate(Request $request): RedirectResponse
    {
        Court::create([
            'rating' => $request->get('rating'),
            'comment' => $request->get('comment'),
            'complex_id' => $request->get('complex_id'),
            'customer_id' => auth()->guard('customer')->user()->id,
        ]);
        return back();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getFreeAppointments(Request $request): JsonResponse
    {
        $complex = Complex::where('name', $request->get('complex'))->first();
        $category = Category::where('type', $request->get('category'))->first();
        $workingHour = WorkingHour::where('day', $request->get('day'))->where('complex_id', $complex->id)->first();
        $appointments = [];
        if ($workingHour) {
            $open = strtotime($request->get('date') . ' ' . $workingHour->open_hour);
            $close = strtotime($request->get('date') . ' ' . $workingHour->close_hour);
            $lastTime = $open;
            for ($i = 0; $i < date('H', $close - $open); $i++) {
                $appointment = Appointment::where('complex_id', $complex->id)
                    ->where('category_id', $category->id)
                    ->where('time_start', date('Y-m-d H:i:s', $lastTime))
                    ->whereHas('reservation', function ($q) {
                        $q->where('status', '<>', '1');
                    })
                    ->first();
                if ($appointment) {
                    $appointments[] = "<li class='date checked disabled-li'>" . date('H:i', $lastTime) . '-' . date('H:i', $lastTime + 3600) . "</li>";
                } else {
                    $appointments[] = "<li class='date'>" . date('H:i', $lastTime) . '-' . date('H:i', $lastTime + 3600) . "</li>";
                }
                $lastTime += 3600;
            }
        }

        return response()->json([
            'appointments' => $appointments
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function reservationAppointments(Request $request): JsonResponse
    {
        $complex = Complex::where('name', $request->get('complex'))->first();
        $category = Category::where('type', $request->get('category'))->first();
        $reservation = Reservation::create([
            'customer_id' => $request->get('customer'),
            'date_of_reservation' => now(),
        ]);
        Appointment::create([
            'appointment_date' => now(),
            'time_start' => $request->get('start_time'),
            'reservation_id' => $reservation->id,
            'category_id' => $category->id,
            'complex_id' => $complex->id,
        ]);
        return response()->json([
            'message' => "Uspesno ste poslali zahtev za termin!"
        ]);
    }
}
