@extends('administrators.layout')
@section('title','Product Add')
@section('content')
    <section class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="mt-2">Product {{ ($item->id ?? 0) > 0 ? 'Edit' : 'Add' }}</h3>
            </div>
            <div class="col-lg-12">
                <form class="mb-3" method="POST" action="/administrator/product/store" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label>Name</label>
                      @if ($item)
                        <input type="hidden" name="id" value="{{ $item->id }}"/>
                      @endif
                      <input type="hidden" name="action" value="{{ ($item->id ?? 0) > 0 ? 'update':'create' }}"/>
                      <input required name="name" value="{{ $item->name ?? '' }}" type="text" class="form-control">
                      @if ($item)
                        <p class="mt-2"><a target="_blank" href="{{ asset('/product/'.$item->alias) }}">{{ asset('/product/'.$item->alias) }}</a></p>
                      @endif
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Image</label>
                                <input name="file" type="file" class="form-control border-0 pl-0">
                            </div>
                        </div>
                        <div class="col-lg-6 text-left">
                            @if ($item)
                                <img class="mt-2" width="55" src="{{ asset('/storage/images/'.$item->image) }}">
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input name="price" value="{{ $item->price ?? '' }}" type="number" class="form-control">
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Make</label>
                                <input name="make" value="{{ $item->make ?? '' }}" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Model</label>
                                <input name="model" value="{{ $item->model ?? '' }}" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Registration</label>
                                <input name="regist_date" value="{{ $item->regist_date ?? '' }}" type="date" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Engine Size</label>
                                <input name="engine" value="{{ $item->engine ?? '' }}" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <input name="category" type="text" value="{{ $item->category ?? '' }}" class="form-control">
                        <small class="form-text text-muted">Each attribute is separated by a ";"</small>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" rows="5" class="form-control">{{ $item->description ?? '' }}</textarea>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label">
                         <input name="status" {{ ($item->status ?? 0) > 0 ? 'checked' : '' }} value="1" type="checkbox" class="form-check-input"> Acitive
                      </label>
                    </div>
                    <br/>
                    <div class="text-center">
                        <a href="/administrator/product/list" class="btn btn-danger">← Back</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </form>
            </div>
        </div>
    </section>
@endsection
