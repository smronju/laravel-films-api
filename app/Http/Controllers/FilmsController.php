<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Film;
use App\Http\Requests\StoreFilm;

class FilmsController extends Controller
{
    public function index() {
        return response()->json(Film::paginate(1));
    }

    public function show($slug) {
        $film = Film::where('slug', $slug)->with('comments')->first();
        return response()->json($film);
    }

    public function store(StoreFilm $request) {
        $file = $request->file('photo');
        $fileName = md5($file->getFilename()) . '.' . $file->extension();

        $film = new Film();

        $film->fill($request->all());
        $film->photo = $fileName;

        if ($film->save()) {
            $request->file('photo')->storeAs('posters', $fileName, 'uploads');
        }

        return response()->json($film);
    }

    public function update(Request $request, Film $film) {
        // TODO: refactor code
        $validator = \Validator::make($request->all(), \Config::get('rules.films'));

        if ($validator->fails()) {
            $validationMessage = $validator->messages();
            return response()->json($validationMessage);
        }

        $file = $request->file('photo');
        $film->fill($request->all());
        $oldfilename = $film->photo;

        if ($file) {
            $fileName = md5($file->getFilename()) . '.' . $file->extension();
            $film->photo = $fileName;
        }

        if ($film->save()) {
            if ($file) {
                $request->file('photo')->storeAs('posters', $fileName, 'uploads');
                // Delete old file
                \Storage::disk('uploads')->delete('posters/' . $oldfilename);
            }
        }

        return response()->json($film);
    }

    public function remove($filmId) {
        $film = Film::find($filmId);

        if ($film) {
            $photo = $film->photo;

            \Storage::disk('uploads')->delete('posters/' . $photo);
            return response()->json(['message' => 'Film deleted!']);
        }

        return response()->json(['message' => 'Film not found!']);
    }
}
