@extends('layout')
@section('title','Cart')
@section('content')
    <section class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="/">Home</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Cart</li>
                    </ol>
                </nav>
            </div>
            <div class="col-lg-12">
                <table class="table">
                    <thead class="thead-dark">
                      <tr>
                        <th width="5%" scope="col">#</th>
                        <th scope="col">Name</th>
                        <th width="15%" scope="col">Category</th>
                        <th width="15%" scope="col">Price</th>
                        <th width="10%" scope="col">Quantity</th>
                        <th width="15%" scope="col">Amount</th>
                        <th width="5%" scope="col">Action</th>
                      </tr>
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
                            <td class="align-middle">{{ $item['name'] }}</td>
                            <td class="align-middle">{{ $item['category'] }}</td>
                            <td class="align-middle">{{ number_format($item['price']) }}$</td>
                            <td class="align-middle">
                                <input style="width:75px" data-id="{{ $item['product_id'] }}" class="quantity_product" value="{{ $item['quantity'] }}" type="number">
                            </td>
                            <td class="align-middle">{{ number_format($item['amount']) }}$</td>
                            <td class="align-middle">
                                <a data-id="{{ $item['product_id'] }}"  class="btn btn-sm btn-danger btn_remove">Remove</a>
                            </td>
                          </tr>
                        @endforeach
                    </tbody>
                  </table>
                  @if(count($cart) > 0)
                    <div class="text-center">
                        <a href="/cart/pay" class="btn btn-light">Buy now →</a>
                    </div>
                  @endif
            </div>
        </div>
    </section>
    <script>
        $('.quantity_product').change(function(e){
            let id = $(this).data('id');
            let quantity = $(this).val();
            if(quantity < 1){
                $(this).val(1);
                alert('Invalid value !');
                return;
            }
            axios.post('/cart/add',{id:id,quantity:quantity,action:'update'}).then(function(response){
                location.reload();
            });
        });

        $('.btn_remove').click(function(e){
            if(confirm('Are you sure want to delete ?')){
                let id = $(this).data('id');
                axios.post('/cart/add',{id:id,action:'remove'}).then(function(response){
                    location.reload();
                });
            }
        });
    </script>
@endsection
