<?php 

namespace App\Services\Concerns;
 
use Illuminate\Support\Facades\Http;
 
trait HasFake
{
    public static function fake($callback): void 
    {
        Http::fake($callback);
    }
}