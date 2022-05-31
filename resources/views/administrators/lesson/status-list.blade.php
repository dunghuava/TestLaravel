@extends('administrators.layout')
@section('title','Lesson Status')
@section('content')
    <style>
        .ui-sortable-helper {
            position: absolute;
            z-index: 2000;
            background: #fff;
            border:1px dotted #257ad4;
            cursor: move;
        }
        .ui-sortable-helper td{
            width: auto;
        }
    </style>
    <section class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex">
                    <h3 class="mt-2">Lesson Status</h3>
                    <a class="mt-2 ml-3 pt-1" href="{{route('admin.lesson_status_add')}}">+ Add new</a>
                </div>
            </div>
            <div class="col-lg-12">
                <table class="table sorted_table">
                    <thead class="thead-dark">
                    <tr>
                        <th width="5%" scope="col">id</th>
                        <th width="10%" scope="col">lesson type</th>
                        <th width="35%" scope="col">name</th>
                        <th width="5%" scope="col">color</th>
                        <th width="5%" scope="col">color_alt_1</th>
                        <th width="5%" scope="col">color_alt_2</th>
                        <th width="5%" scope="col">default</th>
                        <th scope="col">icon</th>
                        <th width="12%" scope="col">action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($items as $key => $item)
                        <tr data-id="{{$item->id}}">
                            <th class="align-middle" scope="row">{{ $item->id }}</th>
                            <td class="align-middle">{{ $item->lesson_type }}</td>
                            <td class="align-middle">{{ $item->name }}</td>
                            <td style="color: {{$item->color}}" class="align-middle">{{ $item->color }}</td>
                            <td style="color: {{$item->color_alt_1}}" class="align-middle">{{ $item->color_alt_1 }}</td>
                            <td style="color: {{$item->color_alt_2}}" class="align-middle">{{ $item->color_alt_2 }}</td>
                            <td class="align-middle">{{ $item->default ? 'yes' : 'no' }}</td>
                            <td class="align-middle">
                                @if($item->icon_url)
                                    <img width="55" src="{{$item->icon_url}}"/>
                                @endif
                            </td>
                            <td class="align-middle" align="right">
                                <a href="{{route('admin.lesson_status_show',$item->id)}}"
                                   class="btn btn-sm btn-success">Edit</a>
                                <a onclick="onDelete({{ $item->id }})" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script>
        $("table tbody").sortable({
            items: 'tr',
            update: function (event, ui) {
                let changes = {};
                $(this).find('tr').each(function (index, item) {
                    changes[$(item).data('id')] = $(item).index();
                })
                axios.post('/administrator/lesson-status/update', {changes: changes}).then(function (response) {
                    // success
                });
            }
        }).disableSelection();

        function onDelete(id) {
            if (confirm('Are you sure want to delete ?')) {
                axios.post('/administrator/lesson-status/delete/' + id).then(function (response) {
                    location.reload();
                });
            }
        }
    </script>
@endsection
