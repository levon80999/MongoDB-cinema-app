<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFilmRequest;
use App\Http\Requests\UpdateFilmRequest;
use App\Models\Actor;
use App\Models\Film;
use App\Models\Producer;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

/**
 * Create, Update, Delete films and related files.
 */
class FilmController extends Controller
{
    /**
     * Fitch all film and return it to view.
     *
     * @return Application|Factory|View
     */
    public function list()
    {
        $films = Film::limit(15)->orderBy('created_at', 'desc')->get();

        return view('admin.films.list', [
            'films' => $films,
        ]);
    }

    /**
     * Create function return view for create new film.
     *
     * @return Application|Factory|View
     */
    public function create(): View
    {
        $producers = Producer::all();
        $actors = Actor::all();

        return view('admin.films.create_edit', [
            'producers' => $producers,
            'actors' => $actors,
        ]);
    }

    /**
     * Store function responsible for validate date and
     * store it in to database.
     *
     * @param StoreFilmRequest $request
     * @return RedirectResponse
     */
    public function store(StoreFilmRequest $request): RedirectResponse
    {
        $film = new Film();

        $film->name = $request->input('name');
        $film->description = $request->input('description');
        $film->date = $request->input('date');
        $film->comingSoon = (bool)$request->input('comingSoon');
        $film->best = (bool)$request->input('best');

        $actors = Actor::select('_id', 'name')->whereIn('_id', $request->input('actors'))->get();

        foreach ($actors as $actor) {
            $film->actors()->associate($actor);
        }
//        $film->actors()->sync($request->input('actors'));

        $producer = Producer::find($request->input('producer_id'));
        $film->producer()->associate($producer);

        if ($file = $request->file('image')) {
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('public/images'), $filename);
            $film->image = $filename;
        }

        if (!$film->save()) {
            return redirect()->route('films.create')->with('success', false);
        }

        return redirect()->route('films.list');
    }

    /**
     * Return given resource to edit view.
     *
     * @param string $id
     * @return Application|Factory|View
     */
    public function edit(string $id) : View
    {
        $film = Film::find($id);
        $producers = Producer::all();
        $actors = Actor::all();

        return view('admin.films.create_edit', [
            'film' => $film,
            'producers' => $producers,
            'actors' => $actors,
        ]);
    }

    /**
     * Update existing resource, clear old files if necessary.
     *
     * @param UpdateFilmRequest $request
     * @param string $id
     * @return RedirectResponse
     */
    public function update(UpdateFilmRequest $request, string $id): RedirectResponse
    {
        $data = $request->validated();
        $film = Film::find($id);

        $film->name = Arr::get($data, 'name', $film->name);
        $film->description = Arr::get($data, 'description', $film->description);
        $film->date = Arr::get($data, 'date', $film->date);
        $film->comingSoon = (bool)Arr::get($data, 'comingSoon', $film->comingSoon);
        $film->best = (bool)Arr::get($data, 'best', $film->best);

        $actors = Actor::select('_id', 'fullName')->whereIn('_id', Arr::get($data, 'actors', $film->actor_ids))->get();

        foreach ($actors as $actor) {
            $film->actors()->associate($actor);
        }
//        $film->actors()->sync(Arr::get($data, 'actors', $film->actor_ids));

        $producer = Producer::find(Arr::get($data, 'producer_id', $film->producer_id));
        $film->producer()->associate($producer);

        if ($file = $request->file('image')) {
            Storage::delete('public/images/' . $film->image);

            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('public/images'), $filename);
            $film->image = $filename;
        }

        if (!$film->save()) {
            redirect()->route('films.edit', ['id' => (string)$film->id])->with('success', false);
        }

        return redirect()->route('films.list');
    }

    /**
     * Delete resource by id.
     *
     * @param string $id
     * @return RedirectResponse
     */
    public function destroy(string $id): RedirectResponse
    {
        Film::where('_id', $id)->delete();

        return redirect()->route('films.list');
    }
}
