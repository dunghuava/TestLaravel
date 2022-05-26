@extends('administrators.layout')
@section('title','Orders')
@section('content')
    <section class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex">
                    <h3 class="mt-2">Order List</h3>
                </div>
            </div>
            <div class="col-lg-12">
                <table class="table">
                    <thead class="thead-dark">
                      <tr>
                        <th width="5%" scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th width="15%" scope="col">Phone</th>
                        <th width="10%" scope="col">Email</th>
                        <th width="15%" scope="col">Address</th>
                        <th width="10%" scope="col">Status</th>
                        <th width="5%" scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $item)
                          <tr>
                            <th class="align-middle" scope="row">{{ $item->id }}</th>
                            <td class="align-middle">{{ $item->name }}</td>
                            <td class="align-middle">{{ $item->phone }}</td>
                            <td class="align-middle">{{ $item->email }}</td>
                            <td class="align-middle">{{ $item->address }}</td>
                            <td class="align-middle">
                                <span>
                                    {{ $item->status_label }}
                                </span>
                            </td>
                            <td class="align-middle" align="right">
                                <a class="btn btn-small btn-success">Show</a>
                            </td>
                          </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
    </section>
@endsection
