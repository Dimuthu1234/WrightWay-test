<?php namespace App\Repositories;
use Bosnadev\Repositories\Eloquent\Repository;
use Illuminate\Container\Container as App;
use Illuminate\Support\Collection;

class ProductRepository extends Repository
{
    public function model()
    {
        return 'App\Product';
    }
    public function getAllProducts($url, $username, $password)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            throw new Exception(curl_error($ch));
        }
        return json_decode($response);
    }
}
