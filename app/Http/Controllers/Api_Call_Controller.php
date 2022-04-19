<?php

namespace App\Http\Controllers;
use App\Services\Blog_api\Client;

class Api_Call_Controller extends Controller
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function index()
    {
        return view('api_call');
    }

    public function store_data()
    {
        
        $comments = $this->client->store_comments();
        $posts = $this->client->store_posts();

        if ($comments && $posts) {
            return redirect('api')->with('status', 'Uspješno ste spremili podatke u bazu!');
        }

        abort(404);
    }
}
