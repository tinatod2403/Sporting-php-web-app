<?php

namespace App\Http\Controllers\Moderator;

use App\Http\Controllers\Controller;
use App\Http\Requests\Moderator\Complex\UpdateRequest;
use App\Models\Category;
use App\Models\Complex;
use App\Models\ComplexCategory;
use App\Models\WorkingHour;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ComplexController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param Complex $complex
     * @return Application|Factory|View
     */
    public function edit(Complex $complex)
    {
        $days = [];
        foreach ($complex->workingHours as $workingHour) {
            $days[$workingHour->day] = [
                'open' => $workingHour->open_hour,
                'close' => $workingHour->close_hour,
            ];
        }

        return view('moderator.pages.complex.show', [
            'item' => $complex,
            'categories' => Category::all(),
            'complexCategories' => $complex->categories->pluck('id')->toArray(),
            'days' => $days,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Complex $complex
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, Complex $complex): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $images = [];
            if ($request->file('images')) {
                foreach ($request->file('images') as $image) {
                    $imagePath = Storage::disk('public')->put('complexes', $image);
                    $images[] = $imagePath;
                }
            }

            $logo = null;
            if ($request->file('logo')) {
                $logo = Storage::disk('public')->put('complexes', $request->file('logo'));
            }

            $data = [
                'name' => $request->get('name'),
                'content' => $request->get('content'),
            ];

            if (!empty($images)) {
                $data['images'] = $images;
            }

            if ($logo) {
                $data['logo'] = $logo;
            }

            $complex->update($data);

            ComplexCategory::where('complex_id', $complex->id)->delete();
            foreach ($request->get('categories') as $category) {
                ComplexCategory::create([
                    'complex_id' => $complex->id,
                    'category_id' => $category,
                ]);
            }

            if ($complex->workingHours->count()) {
                foreach ($request->get('days') as $day) {
                    $data = [
                        'open' => '',
                        'close' => '',
                    ];

                    if (isset($day['open']) && isset($day['close'])) {
                        $data = [
                            'open' => $day['open'],
                            'close' => $day['close'],
                        ];
                    }

                    $workingHour = WorkingHour::where('complex_id', $complex->id)->where('day', $day['name'])->first();
                    $workingHour->update([
                        'open_hour' => $data['open'],
                        'close_hour' => $data['close'],
                    ]);
                }
            } else {
                foreach ($request->get('days') as $day) {
                    $data = [
                        'open' => '',
                        'close' => '',
                    ];

                    if (isset($day['open']) && isset($day['close'])) {
                        $data = [
                            'open' => $day['open'],
                            'close' => $day['close'],
                        ];
                    }
                    WorkingHour::create([
                        'day' => $day['name'],
                        'open_hour' => $data['open'],
                        'close_hour' => $data['close'],
                        'complex_id' => $complex->id,
                    ]);
                }
            }

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();

            return back()->withErrors('Unsuccessfully to update complex!');
        }

        return back()->with(['success' => 'Successfully to updated complex!']);
    }
}
