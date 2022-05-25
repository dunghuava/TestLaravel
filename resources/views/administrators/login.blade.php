@extends('administrators.layout')
@section('title','Admin Login')
@section('content')
    <section class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <br>
                <h3 class="title">Admin login</h3>
                <form method="POST" class="mb-2">
                    @csrf
                    <div class="form-group">
                    <label>Email address</label>
                    <input name="email" type="email" class="form-control" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                    <label>Password</label>
                    <input name="password" type="password" class="form-control" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                <br/>
            </div>
        </div>
    </section>
@endsection
