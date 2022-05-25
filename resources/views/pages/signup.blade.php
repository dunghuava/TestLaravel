@extends('layout')
@section('title','Login')
@section('content')
    <section class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <br>
                <h3 class="title">Signup</h3>
                <form id="formSignup" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Full name</label>
                        <input required name="name" type="text" class="form-control" placeholder="Full name">
                      </div>
                    <div class="form-group">
                      <label>Email address</label>
                      <input required name="email" type="email" class="form-control" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                      <label>Password</label>
                      <input required id="password" name="password" type="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label>Confirm password</label>
                        <input id="password_confirm" name="password_confirm" type="password" class="form-control" placeholder="Confirm password">
                      </div>
                    <p>
                        <a href="/user/login">Already have an account ?</a>
                    </p>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
            </div>
        </div>
    </section>
    <script>
        $('#formSignup').submit(function(e){
            let password = $('#password');
            let password_confirm = $('#password_confirm');
            if (password_confirm.val() != password.val()) {
                alert('Password does not match');
                return false;
            }
            return true;
        });
    </script>
@endsection
