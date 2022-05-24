@extends('layout')
@section('title','Cart')
@section('content')
    <section class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="/">Home</a></li>
                      <li class="breadcrumb-item"><a href="/cart">Cart</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Payment</li>
                    </ol>
                </nav>
            </div>
            <div class="col-lg-7">
                <h3>Infomation</h3>
                <form method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Full name</label>
                        <input required value="{{ $user->name }}" name="name" type="text" class="form-control" placeholder="Full name">
                    </div>
                    <div class="form-group">
                        <label>Contact email</label>
                        <input required value="{{ $user->email }}" name="email" type="email" class="form-control" placeholder="Full name">
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input required name="address" type="text" class="form-control" placeholder="Address">
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input required name="phone" type="text" class="form-control" placeholder="Phone">
                    </div>
                    <div class="form-group">
                        <label>Note</label>
                        <textarea name="note" class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
            </div>
            <div class="col-lg-5">
                <h3>Order</h3>
                <table class="table">
                    <thead>
                        <th>#</th>
                        <th>Name</th>
                        <th>Amount</th>
                    </thead>
                    <tbody>
                        @php
                            $index = 0;
                        @endphp
                        @foreach ($cart as $item)
                            @php
                                $index ++;
                            @endphp
                            <tr>
                                <td scope="row">{{ $index }}</td>
                                <td class="align-middle">{{ $item['name'] . ' x ' . $item['quantity'] }}</td>
                                <td class="align-middle">{{ number_format($item['amount']) }}$</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
