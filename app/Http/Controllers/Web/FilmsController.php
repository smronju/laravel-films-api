<?php

namespace App\Http\Controllers\Web;

use App\Film;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Pagination\LengthAwarePaginator;

class FilmsController extends Controller
{
    protected $apiUrl;
    protected $clent;

    public function __construct() {
        $this->apiUrl = url('/');
        $this->client = new Client();
    }

    public function index() {
         return redirect()->route('all.films');
    }

    public function films(Request $request) {
        $response = $this->client->get($this->apiUrl . '/api/films', [
            'query' => [
                'page' => $request->page,
            ]
        ]);

        $objects = json_decode($response->getBody());
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $paginatedItems= new LengthAwarePaginator($objects->data , $objects->total, 1);
        $paginatedItems->setPath($request->url());

        return view('films.index')->with(['films' => $paginatedItems]);

    }

    public function show($slug) {
        $response = $this->client->get($this->apiUrl . '/api/films/' . $slug);
        $film = json_decode($response->getBody());

        return view('films.show')->with(compact('film'));
    }


    public function create() {
        return view('films.create');
    }

    public function store(Request $request) {
        $file = $request->file('photo');
        $fileName = $file->getClientOriginalName();
        $realPath = $file->getRealPath();

        try {
            $response = $this->client->request('POST', $this->apiUrl . '/api/films', [
                'multipart' => [
                    ['name' => 'name', 'contents' => $request->input('name')],
                    ['name' => 'description', 'contents' => $request->input('description')],
                    ['name' => 'release_date', 'contents' => date('Y-m-d', strtotime($request->get('release_date')))],
                    ['name' => 'rating', 'contents' => $request->input('rating')],
                    ['name' => 'ticket_price', 'contents' => $request->input('ticket_price')],
                    ['name' => 'country', 'contents' => $request->input('country')],
                    ['name' => 'genre', 'contents' => $request->input('genre')],
                    ['name' => 'photo', 'contents' => file_get_contents($realPath), 'filename' => $fileName],
                ]
            ]);

            if ($response->getStatusCode() === 200) {
                return redirect()->route('all.films')->with('status', 'Film saved successfully!');
            }
        } catch (ClientException $exception) {
            $response = $exception->getResponse();

            if ($response->getStatusCode() === 422) {
                return redirect()->back()->with('status', 'Provide all required field value!');
            }

            return redirect()->back()->with('status', 'Something went wrong!');
        }
    }

}
