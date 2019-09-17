@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Products</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Cost Price</th>
                                <th>Sale Price</th>
                                <th width="1%"></th>
                                <th width="1%"></th>
                                <th width="1%"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td>{{ $product->ProductID }}</td>
                                <td>{{ $product->Name }}</td>
                                <td>{{ $product->CostPrice }}</td>
                                <td>{{ $product->SalePrice }}</td>
                                <td><a href="#">View</a></td>
                                <td><a href="#">Edit</a></td>
                                <td><a href="#">Delete</a></td>
                            </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
