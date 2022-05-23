@extends('administrators.layout')
@section('title','Product Add')
@section('content')
    <section class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="mt-2">Product Add</h3>
            </div>
            <div class="col-lg-12">
                <form class="mb-3" action="" method="POST">
                    @csrf
                    <div class="form-group">
                      <label>Name</label>
                      <input type="hidden" name="action" value="create"/>
                      <input name="name" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input name="price" type="number" class="form-control">
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Make</label>
                                <input name="make" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Model</label>
                                <input name="model" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Registration</label>
                                <input name="regist_date" type="date" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Engine Size</label>
                                <input name="engine" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <input name="category" type="text" class="form-control">
                        <small class="form-text text-muted">Each attribute is separated by a ";"</small>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" rows="5" class="form-control"></textarea>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label">
                         <input name="status" type="checkbox" class="form-check-input"> Acitive
                      </label>
                    </div>
                    <br/>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
            </div>
        </div>
    </section>
@endsection
