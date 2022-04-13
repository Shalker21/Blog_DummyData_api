<?php 

namespace App\Services\Blog_api;

use App\Services\Concerns\HasFake;
use Illuminate\Support\Facades\Http;

class Client 
{
    use HasFake;

    protected $uri;
    protected $token;
    protected int $timeout; 
    protected int $retryTimes; // how much times laravel will retry (pokusaji) 
    protected int $retryMilliseconds; // how much long should wait bettween attempts

    public function __construct(
        string $uri, 
        string $token,
        int $timeout,
        int $retryTimes,
        int $retryMilliseconds
    ) 
    {
        $this->uri = $uri;
        $this->token = $token;
        $this->timeout = $timeout;
        $this->retryTimes = $retryTimes;
        $this->retryMilliseconds = $retryMilliseconds;
    }

    public function testing()
    {
        // HasFake::fake($response ?????);
    }

    public function posts()
    {
        $request = Http::withToken($this->token) // do we need to send this token like that ??? because in docs it says to pass it in headers like app-id => token
        ->withHeaders([

            'app-id' => $this->token,
            'Accept' => 'application/json',
        
        ])->timeout(
        
            $this->timeout,
        
        );

        if (! is_null($this->retryTimes) && ! is_null($this->retryMilliseconds)) {
        
            $request->retry($this->retryTimes, $this->retryMilliseconds); // times, sleep
        
        }

        $response = $request->get($this->uri . "/post?page=5&limit=10");

        if (! $response->successful()) {
        
            return $response->toException();
        
        }

        return $response;
    }



}