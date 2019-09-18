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

    public function updateProduct($url, $request, $username, $password){
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_USERPWD, $username . ":" . $password);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($request->input()));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        if (curl_errno($curl)) {
            throw new Exception(curl_error($curl));
        }
        return json_decode($response);
    }
}
