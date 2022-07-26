<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSessionRequest;
use App\Models\Film;
use App\Models\Hall;
use App\Models\Session;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;

class SessionController extends Controller
{
    public function list()
    {
        $sessions = Session::limit(15)->orderBy('created_at', 'desc')->get();

        return view('admin.sessions.list', [
            'sessions' => $sessions,
        ]);
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        $films = Film::orderBy('created_at', 'desc')->get();
        $halls = Hall::orderBy('created_at', 'desc')->get();

        return view('admin.sessions.create_edit', [
            'films' => $films,
            'halls' => $halls,
        ]);
    }

    /**
     * Store request.
     *
     * @param StoreSessionRequest $request
     * @return RedirectResponse
     */
    public function store(StoreSessionRequest $request) : RedirectResponse
    {
        $session = new Session();

        $session->film_id = $request->input('film_id');
        $session->hall_id = $request->input('hall_id');
        $session->start_date = $request->input('start_date');
        $session->end_date = $request->input('end_date');

        if (!$session->save()) {
            return redirect()->route('sessions.create')->with('success', false);
        }

        return redirect()->route('sessions.list');
    }

    /**
     * @param string $id
     * @return View
     */
    public function edit(string $id) : View
    {
        $session = Session::findOrFail($id);
        $films = Film::orderBy('created_at', 'desc')->get();
        $halls = Hall::orderBy('created_at', 'desc')->get();

        return view('admin.sessions.create_edit', [
            'films' => $films,
            'halls' => $halls,
            'session' => $session,
        ]);
    }

    public function update(StoreSessionRequest $request, string $id) : RedirectResponse
    {
        $session = Session::find($id);

        $data = $request->validated();

        $session->film_id = Arr::get($data, 'film_id', $session->film_id);
        $session->hall_id = Arr::get($data, 'hall_id', $session->hall_id);
        $session->start_date = Arr::get($data, 'start_date', $session->start_date);
        $session->end_date = Arr::get($data, 'end_date', $session->end_date);

        if (!$session->save()) {
            return redirect()->route('sessions.edit', ['id' => $id])->with('success', false);
        }

        return redirect()->route('sessions.list');
    }

    /**
     * Delete resource by id.
     *
     * @param string $id
     * @return RedirectResponse
     */
    public function destroy(string $id): RedirectResponse
    {
        Session::where('_id', $id)->delete();

        return redirect()->route('sessions.list');
    }
}
