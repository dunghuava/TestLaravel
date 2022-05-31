@extends('layout')
@section('title','Trang chủ')
@section('content')
    <section class="container">
        <div class="row">
            <div class="col-lg-8">
                <h3 class="title">Find new & used cars for sale</h3>
                <p>Popular searches near you.</p>
            </div>
            <div class="col-lg-4">
                <form class="form-group form-inline float-right" method="GET">
                    <input value="{{ $query }}" name="q" placeholder="Search..." class="form-control" type="search"/>&nbsp;
                    <button class="btn btn-danger" type="submit">Search</button>
                </form>
            </div>
            @foreach ( $product as $item )
                <div class="col-lg-3">
                    <div class="product-item mt-2 shadow p-2">
                            <img src="{{ asset('/storage/images/'.$item->image) }}">
                            <a href="{{ asset('/product/'.$item->alias) }}">
                                <p class="mb-1">{{ $item->name }}</p>
                            </a>
                            <p class="mb-1">Price: {{ number_format($item->price).'$' }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
