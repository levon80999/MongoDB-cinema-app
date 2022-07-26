<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHallRequest;
use App\Models\Hall;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;

class HallController extends Controller
{
    /**
     * Retrieve all halls.
     *
     * @return Application|Factory|View
     */
    public function list()
    {
        $halls = Hall::limit(15)->orderBy('created_at', 'desc')->get();

        return view('admin.halls.list', [
            'halls' => $halls,
        ]);
    }

    /**
     * Return view for creating new hall.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.halls.create_edit');
    }

    /**
     * Store hall to db
     *
     * @param StoreHallRequest $request
     * @return RedirectResponse
     */
    public function store(StoreHallRequest $request): RedirectResponse
    {
        $hall = new Hall();

        $hall->name = $request->input('name');
        $hall->row = $request->input('row');
        $hall->col = $request->input('col');
        $seats = $request->input('seats');

        $hall->disabledSeats = $this->getDisabledSeats($hall, $seats);

        if (!$hall->save()) {
            return redirect()->route('halls.create')->with('success', false);
        }

        return redirect()->route('halls.list');
    }

    /**
     * Return edit view.
     *
     * @param string $id
     * @return Application|Factory|View
     */
    public function edit(string $id) : View
    {
        $hall = Hall::find($id);

        return view('admin.halls.create_edit', [
            'hall' => $hall,
        ]);
    }

    /**
     * Update resource in db.
     *
     * @param StoreHallRequest $request
     * @param string $id
     * @return RedirectResponse
     */
    public function update(StoreHallRequest $request, string $id): RedirectResponse
    {
        $hall = Hall::findOrFail($id);
        $requestData = $request->validated();

        $hall->name = Arr::get($requestData, 'name', $hall->name);
        $hall->row = Arr::get($requestData, 'row', $hall->row);
        $hall->col = Arr::get($requestData, 'col', $hall->col);
        $seats = $request->input('seats');

        $hall->disabledSeats = $this->getDisabledSeats($hall, $seats);

        if (!$hall->save()) {
            return redirect()->route('halls.edit', ['id' => $id])->with('success', false);
        }

        return redirect()->route('halls.list');
    }

    /**
     * Return disabled seats array.
     *
     * @param Hall $hall
     * @param array $seats
     * @return array|null
     */
    private function getDisabledSeats(Hall $hall, array $seats) : ?array
    {
        $disabledSeats = [];

        for ($i = 1; $i <= $hall->row; $i++) {
            for ($j = 1; $j <= $hall->col; $j++) {
                if (!isset($seats[$i][$j])) {
                    $disabledSeats[$i][] = $j;
                }
            }
        }

        return $disabledSeats;
    }

    /**
     * Delete resource by id.
     *
     * @param string $id
     * @return RedirectResponse
     */
    public function destroy(string $id): RedirectResponse
    {
        Hall::where('_id', $id)->delete();

        return redirect()->route('halls.list');
    }
}
