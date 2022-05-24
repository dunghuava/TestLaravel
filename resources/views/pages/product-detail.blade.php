@extends('layout')
@section('title','Cart')
@section('content')
    <section class="container mt-3">
        <div class="row">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="/">Home</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Product</li>
                    </ol>
                </nav>
            </div>
            <div class="col-lg-5">
                <div class="product-detail border">
                    <img src="https://www.cstatic-images.com/car-pictures/main/USC50FOT113A021001.png">
                </div>
            </div>
            <div class="col-lg-7">
                <div class="content">
                    <h3>{{ $product->name }}</h3>
                    <p>Price: {{ number_format($product->price) }}$</p>
                    <p>{{ $product->description }}</p>
                    <form method="post" action="/cart/add">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <button type="submit" class="btn btn-danger">+ Add to cart</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
