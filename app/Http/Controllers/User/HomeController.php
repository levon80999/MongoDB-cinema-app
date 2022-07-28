<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Actor;
use App\Models\Film;
use App\Models\Producer;
use App\Models\Session;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function main() : View
    {
        $bestFilms = Film::where('best', true)->orderByDesc('created_at')->limit(4)->get();
        $comingSoon = Film::where('comingSoon', true)->orderByDesc('created_at')->limit(4)->get();
        $recentFilms = Film::orderByDesc('created_at')->limit(4)->get();

        return view('user.pages.home', [
            'bestFilms' => $bestFilms,
            'comingSoon' => $comingSoon,
            'recentFilms' => $recentFilms,
        ]);
    }

    public function search(Request $request)
    {
        $films = Film::when($request->input('film_name'), function ($q) use ($request) {
            $q->where('name', 'regexp', '/'.$request->input('film_name').'/');
        })->when($request->input('actor_name'), function ($q) use ($request) {
            $q->where('actors.fullName', 'regexp', '/'.$request->input('actor_name').'/');
        })->when($request->input('producer_name'), function ($q) use ($request) {
            $q->where();
        })->when($request->input('year'), function ($q) use ($request) {
            $q->where('date', 'regex', $request->input('year'));
        })->orderByDesc('created_at')
            ->get();

        return view('user.pages.search', [
            'films' => $films
        ]);
    }

    /**
     * @param string $id
     * @return View
     */
    public function filmView(string $id) : View
    {
        $film = Film::where('_id', $id)->with(['producer', 'actors'])->firstOrFail();

        return view('user.pages.film_single', [
            'film' => $film,
        ]);
    }

    /**
     * @param string $id
     * @return View
     */
    public function producerView(string $id) : View
    {
        $producer = Producer::where('_id', $id)->with('films')->firstOrFail();

        return view('user.pages.producer_single', [
            'producer' => $producer,
        ]);
    }

    /**
     * @param string $id
     * @return View
     */
    public function actorView(string $id) : View
    {
        $actor = Actor::where('_id', $id)->firstOrFail();

        return view('user.pages.actor_single', [
            'actor' => $actor,
        ]);
    }

    /**
     * @param string $film_id
     * @return View
     */
    public function chooseSession(string $film_id) : View
    {
        $sessions = Session::where('film_id', $film_id)->orderBy('start_date', 'desc')->get();

        return view('user.pages.choose_session', [
            'sessions' => $sessions,
        ]);
    }

    /**
     * @param string $session
     * @return View
     */
    public function bookSession(string $session) : View
    {
        $session = Session::findOrFail($session);

        return view('user.pages.book_session', [
            'session' => $session,
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function book(Request $request) : RedirectResponse
    {
        $session = Session::find($request->input('sessionId'));

        $session->books = array_merge($session->books, $request->input('seats'));
        $session->save();

        return redirect()->route('film.view', ['id' => $session->film_id]);
    }
}
