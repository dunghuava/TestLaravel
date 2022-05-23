@extends('layout')
@section('title','Trang chủ')
@section('content')
    <div class="row">
        <div class="col-lg-8">
            <h3 class="title">Find new & used cars for sale</h3>
            <p>Popular searches near you.</p>
        </div>
        <div class="col-lg-4">
            <form class="form-group form-inline float-right" method="GET" action="/">
                <input placeholder="Search..." class="form-control" type="search"/>&nbsp;
                <button class="btn btn-danger" type="submit">Search</button>
            </form>
        </div>
        @for ($i=0;$i<8;$i++)
            <div class="col-lg-3">
                <div class="product-item mt-2 shadow p-2">
                    <a href="/product/detailt">
                        <img src="https://www.cstatic-images.com/car-pictures/main/USC50FOT113A021001.png">
                    </a>
                    <p>Item</p>
                </div>
            </div>
        @endfor
    </div>
@endsection
