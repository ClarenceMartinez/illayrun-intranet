<?php namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait HttpClientTrait {

    public function get($endpoint, $params){
        return Http::get(config('const.api') . $endpoint, $params);
    }
    public function post($endpoint, $params){
        return Http::post(config('const.api') . $endpoint, $params);
    }

    public function put($endpoint, $params){
        return Http::put(config('const.api') . $endpoint, $params);
    }

    public function delete($endpoint, $params){
        return Http::delete(config('const.api') . $endpoint, $params);
    }
}