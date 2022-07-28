<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProducerRequest;
use App\Http\Requests\UpdateProducerRequest;
use App\Models\Producer;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

/**
 * Create, Update, Delete produces and related files.
 */
class ProducerController extends Controller
{
    public function list()
    {
        $producers = Producer::limit(15)->orderBy('created_at', 'desc')->get();

        return view('admin.producers.list', [
            'producers' => $producers,
        ]);
    }

    public function create()
    {
        return view('admin.producers.create_edit');
    }

    public function store(StoreProducerRequest $request)
    {
        $producer = new Producer();

        $producer->fullName = $request->input('fullName');
        $producer->description = $request->input('description');
        $producer->height = $request->input('height');
        $producer->dateOfBirth = $request->input('dateOfBirth');
        $producer->placeOfBirth = $request->input('placeOfBirth');
        $producer->children = explode(',', $request->input('children'));
        $producer->parents = explode(',', $request->input('parents'));

        if ($file = $request->file('image')) {
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('public/producers/images'), $filename);
            $producer->image = $filename;
        }

        if (!$producer->save()) {
            return redirect()->route('producers.create')->with('success', false);
        }

        return redirect()->route('producers.list');
    }

    /**
     * Fetch data by given id and return to view.
     *
     * @param string $id
     * @return Application|Factory|View
     */
    public function edit(string $id) : View
    {
        $producer = Producer::findOrFail($id);

        return view('admin.producers.create_edit', [
            'producer' => $producer
        ]);
    }

    /**
     * Update given resource.
     *
     * @param UpdateProducerRequest $request
     * @param string $id
     * @return RedirectResponse
     */
    public function update(UpdateProducerRequest $request, string $id): RedirectResponse
    {
        $data = $request->validated();

        $producer = Producer::findOrFail($id);

        $producer->fullName = Arr::get($data,'fullName', $producer->fullName);
        $producer->description = Arr::get($data,'description', $producer->description);
        $producer->height = Arr::get($data,'height', $producer->height);
        $producer->dateOfBirth = Arr::get($data,'dateOfBirth', $producer->dateOfBirth);
        $producer->placeOfBirth = Arr::get($data,'placeOfBirth', $producer->placeOfBirth);
        $producer->children = explode(',', Arr::get($data,'children')) ?? $producer->children;
        $producer->parents = explode(',', Arr::get($data,'parents')) ?? $producer->parents;

        if ($file = $request->file('image')) {
            Storage::delete('public/producers/images/' . $producer->image);

            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('public/producers/images'), $filename);
            $producer->image = $filename;
        }

        if (!$producer->save()) {
            redirect()->route('producers.edit', ['id' => (string)$producer->id])->with('success', false);
        }

        return redirect()->route('producers.list');
    }

    /**
     * Find and delete given resource.
     *
     * @param string $id
     * @return RedirectResponse
     */
    public function destroy(string $id) : RedirectResponse
    {
        Producer::find($id)->delete();

        return redirect()->route('producers.list');
    }
}
