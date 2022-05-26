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
                        <th width="5%" scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th width="15%" scope="col">Price</th>
                        <th width="10%" scope="col">Status</th>
                        <th width="15%" scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                          <tr>
                            <th class="align-middle" scope="row">{{ $item->id }}</th>
                            <td class="align-middle">{{ $item->name }}</td>
                            <td class="align-middle">{{ number_format($item->price) }}</td>
                            <td class="align-middle">
                                <span class="p-2 badge badge-{{ $item->status ? 'success':'danger' }}">
                                    {{ $item->status ? 'Active':'Hidden' }}
                                </span>
                            </td>
                            <td class="align-middle" align="right">
                                <a href="/administrator/product/{{ $item->id }}/edit" class="btn btn-small btn-success">Edit</a>
                                <a onclick="onDelete({{ $item->id }})" class="btn btn-small btn-danger">Delete</a>
                            </td>
                          </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
    </section>
    <script>
        function onDelete(id)
        {
            if(confirm('Are you sure want to delete ?')){
                axios.post('/administrator/product/delete/'+id).then(function(response){
                    location.reload();
                });
            }
        }
    </script>
@endsection
