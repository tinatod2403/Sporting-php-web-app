<?php

namespace App\Http\Controllers\Moderator;

use App\Http\Controllers\Controller;
use App\Http\Requests\Moderator\News\CreateRequest;
use App\Http\Requests\Moderator\News\UpdateRequest;
use App\Models\News;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        return view('moderator.pages.news.index', [
            'list' => News::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('moderator.pages.news.show');
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

            $imagePath = Storage::disk('public')->put('news', $request->file('image'));

            News::create([
                'title' => $request->get('title'),
                'content' => $request->get('content'),
                'type' => $request->get('type'),
                'path_image' => $imagePath,
                'moderator_id' => auth()->guard('moderator')->user()->id,
            ]);

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();

            return back()->withErrors('Unsuccessfully to create news!');
        }

        return redirect()->route('moderator.news.index')->with(['success' => 'Successfully to created news!']);
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
     * @param News $news
     * @return Application|Factory|View
     */
    public function edit(News $news)
    {
        return view('moderator.pages.news.show', ['item' => $news]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param News $news
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, News $news): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $data = [
                'title' => $request->get('title'),
                'content' => $request->get('content'),
                'type' => $request->get('type'),
            ];

            if ($request->file('image')) {
                $imagePath = Storage::disk('public')->put('news', $request->file('image'));
                $data['path_image'] = $imagePath;
            }

            $news->update($data);

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();

            return back()->withErrors('Unsuccessfully to update news!');
        }

        return redirect()->route('moderator.news.index')->with(['success' => 'Successfully to updated news!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param News $news
     * @return RedirectResponse
     */
    public function destroy(News $news): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $news->delete();

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();

            return back()->withErrors('Unsuccessfully to delete news!');
        }

        return back()->with(['success' => 'Successfully to deleted news!']);
    }
}
