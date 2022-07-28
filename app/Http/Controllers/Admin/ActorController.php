<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreActorRequest;
use App\Http\Requests\UpdateActorRequest;
use App\Models\Actor;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

/**
 * Create, Update, Delete actors and related files.
 */
class ActorController extends Controller
{
    /**
     * Fetch actors list.
     *
     * @return Application|Factory|View
     */
    public function list() : View
    {
        $actors = Actor::limit(15)->orderByDesc('created_at')->get();

        return view('admin.actors.list', [
            'actors' => $actors,
        ]);
    }

    /**
     * Create function return view for create new actor.
     *
     * @return Application|Factory|View
     */
    public function create() : View
    {
        return view('admin.actors.create_edit');
    }

    /**
     * @param StoreActorRequest $request
     * @return RedirectResponse
     */
    public function store(StoreActorRequest $request) : RedirectResponse
    {
        $actor = new Actor();

        $actor->fullName = $request->input('fullName');
        $actor->description = $request->input('description');
        $actor->height = $request->input('height');
        $actor->dateOfBirth = $request->input('dateOfBirth');
        $actor->children = explode(',', $request->input('children'));

        if ($file = $request->file('image')) {
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('public/actors/images'), $filename);
            $actor->image = $filename;
        }

        if (!$actor->save()) {
            return redirect()->route('actors.create')->with('success', false);
        }

        return redirect()->route('actors.list');
    }

    /**
     * @param string $id
     * @return Application|Factory|View
     */
    public function edit(string $id) : View
    {
        $actor = Actor::find($id);

        return view('admin.actors.create_edit', [
            'actor' => $actor,
        ]);
    }

    /**
     * Update existing resource by given id.
     *
     * @param UpdateActorRequest $request
     * @param string $id
     * @return RedirectResponse
     */
    public function update(UpdateActorRequest $request, string $id) : RedirectResponse
    {
        $data = $request->validated();

        $actor = Actor::find($id);

        $actor->fullName = Arr::get($data,'fullName', $actor->fullName);
        $actor->description = Arr::get($data,'description', $actor->description);
        $actor->height = Arr::get($data,'height', $actor->height);
        $actor->dateOfBirth = Arr::get($data,'dateOfBirth', $actor->dateOfBirth);
        $actor->children = explode(',', Arr::get($data,'children')) ?? $actor->children;

        if ($file = $request->file('image')) {
            Storage::delete('public/actors/images/' . $actor->image);

            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('public/actors/images'), $filename);
            $actor->image = $filename;
        }

        if (!$actor->save()) {
            redirect()->route('actors.edit', ['id' => (string)$actor->id])->with('success', false);
        }

        return redirect()->route('actors.list');
    }

    /**
     * Destroy given resource from db.
     *
     * @param string $id
     * @return RedirectResponse
     */
    public function destroy(string $id): RedirectResponse
    {
        Actor::find($id)->delete();

        return redirect()->route('actors.list');
    }
}
