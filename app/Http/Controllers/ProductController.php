<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $username;
    private $password;

    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
       $this->productRepository = $productRepository;
       $this->username = 'VB7UNRDK5CG9DZ404NNTMYK4HFVMFMUP';
       $this->password = 'MSK4Z668IAXMIFDJ3PUA4SNNOXDNOQF9';
    }

    public function viewIndex(){
        return view('products.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $url = 'https://api.eposnowhq.com/api/v2/Product';
        $getAllProducts = $this->productRepository->getAllProducts($url, $this->username, $this->password);
        return response()->json(['data' => $getAllProducts]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $url = "https://api.eposnowhq.com/api/v2/Product/$id";
        $updateProduct = $this->productRepository->updateProduct($url, $request, $this->username, $this->password);
        return response()->json(['data' => $updateProduct]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
