<?php 

namespace App\Services\Blog_api;

use App\Services\Concerns\HasFake;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class Client 
{
    use HasFake;

    protected $uri;
    protected $token;
    protected int $timeout; 
    protected int $retryTimes; // how much times laravel will retry (pokusaji) 
    protected int $retryMilliseconds; // how much long should wait bettween attempts

    private $response;

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

    public function store_comments() : bool
    {
        return $this->_store('comment', ['_id', 'post_id', 'message']);
    }

    public function store_posts() : bool
    {
        return $this->_store('post', ['_id', 'image_url', 'text', 'likes']);
    }

    private function _store(string $table, array $data) : bool
    {
        $request = Http::withToken($this->token)
        ->withHeaders([

            'app-id' => $this->token,
            'Accept' => 'application/json',
        
        ])->timeout(
        
            $this->timeout,
        
        );

        if (! is_null($this->retryTimes) && ! is_null($this->retryMilliseconds)) {
        
            $request->retry($this->retryTimes, $this->retryMilliseconds); // times, sleep
        
        }
        
        $limit = 20;
        $page = 0;

        while ($page < 999) {
                
            $response = $request->get($this->uri . "/".$table."?limit".$limit."&page=".$page);

            if (! json_decode($response)->data) {
                break;
            }


            if (! $response->successful()) {
    
                abort(404, $response->toException());
    
            }
                    
            $this->response = json_decode($response);

            $db_inset_data = [];

            foreach ($this->response->data as $number => $key_of_value) {

                $insert_data = [];

                foreach ($key_of_value as $key => $value) {

                    foreach ($data as $data_type) {
                        
                        if (Str::contains($data_type, $key)) {                            
                    
                            $insert_data[$data_type] = $value;
                        
                        }
                    
                    }   
                        
                }

                array_push($db_inset_data, $insert_data);
            }

            $t = $table."s";

            try {

                DB::table($t)->insert($db_inset_data); 

            } catch (\Throwable $th) {

                report($th);
            
            }

            $page++;
        }
 
        return true;   
    }

}