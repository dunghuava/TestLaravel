@extends('administrators.layout')
@section('title','Lesson Status')
@section('content')
    <section class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="mt-2">Lesson Status {{ ($item->id ?? 0) > 0 ? 'Edit' : 'Add' }}</h3>
            </div>
            <div class="col-lg-12">
                <form class="mb-3" method="POST" action="{{route('admin.lesson_status_store')}}"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        @if ($item)
                            <input type="hidden" name="id" value="{{ $item->id }}"/>
                        @endif
                        <label>lesson_type</label>
                        <select name="lesson_type" class="form-control">
                            @foreach($lesson_status as $status)
                                <option {{$item && $item->lesson_type == $status ? 'selected' : '' }} value="{{$status}}">{{$status}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>name</label>
                        <input required name="name" value="{{ $item->name ?? '' }}" type="text" class="form-control">
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>color</label>
                                <input name="color" value="{{ $item->color ?? '' }}" type="color" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>color_alt_1</label>
                                <input name="color_alt_1" value="{{ $item->color_alt_1 ?? '#000000' }}" type="color"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>color_alt_1</label>
                                <input name="color_alt_2" value="{{ $item->color_alt_2 ?? '#000000' }}" type="color"
                                       class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>icon</label>
                                <input name="icon" type="file" class="form-control border-0 pl-0">
                            </div>
                        </div>
                        <div class="col-lg-6 text-left">
                            @if ($item && $item->icon_url)
                                <input type="hidden" name="icon_url" value="{{$item->icon_url}}">
                                <img class="mt-2" width="55" src="{{ $item->icon_url }}">
                            @endif
                        </div>
                    </div>
                    <div class="form-check pl-0">
                        <label class="form-check-label">
                            order_index <input class="form-control" name="order_index" value="{{$item->order_index ?? 0}}" type="number">
                        </label>
                        <label class="form-check-label pl-5">
                            <input name="default" {{ $item && $item->default > 0 ? 'checked' : '' }} value="1"
                                   type="checkbox" class="form-check-input"> default
                        </label>
                    </div>
                    <br/>
                    <div class="text-center">
                        <a href="{{route('admin.lesson_status')}}" class="btn btn-danger">← Back</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
