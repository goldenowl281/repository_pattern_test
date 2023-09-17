@extends('layouts.app')

@section('content')

<h1 class="text-center mt-2">All Products</h1>
<hr>
<br>

<div class="container">
    <a href="{{ route('product.create') }}"
        class="btn btn-primary">
        Create Product
    </a>
    <div class="row">
        @foreach ($products as $product)
        <div class="col-md-3" style="display:flex">
            <div class="card m-2 p-2" style="width: 18rem;">
                <img src="{{ asset('images/'. $product->image) }}"
                    class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->title }}</h5>
                    <h5 class="card-title">Price: ${{ $product->price }}</h5>
                    <hr>
                    <p class="card-text">{{ $product->description}} </p>
                </div>
                <a href="{{--{{ route('product.detail', $product->id) }}--}}#" class="btn btn-primary">View Detail</a>
            </div>
        </div>
        @endforeach
    </div>
</div>


@endsection
