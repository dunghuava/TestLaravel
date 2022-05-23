@extends('administrators.layout')
@section('title','Product')
@section('content')
    <section class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex">
                    <h3 class="mt-2">Product</h3>
                    <a class="mt-2 ml-3 pt-1" href="/administrator/product/add">+ Add new</a>
                </div>
            </div>
            <div class="col-lg-12">
                <table class="table">
                    <thead class="thead-dark">
                      <tr>
                        <th width="5%" scope="col">#</th>
                        <th scope="col">Name</th>
                        <th width="15%" scope="col">Price</th>
                        <th width="10%" scope="col">Status</th>
                        <th width="15%" scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                          <tr>
                            <th scope="row">{{ $item->id }}</th>
                            <td>{{ $item->name }}</td>
                            <td>{{ number_format($item->price) }}</td>
                            <td>{{ $item->status }}</td>
                            <td align="right">
                                <a href="/administrator/product/{{ $item->id }}/edit" class="btn btn-small btn-success">Edit</a>
                                <a href="/administrator/product/" class="btn btn-small btn-danger">Delete</a>
                            </td>
                          </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
    </section>
@endsection
