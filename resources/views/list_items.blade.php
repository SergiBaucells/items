@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Items list
@endsection

@section('contentheader_title')
    Items list
@endsection

@section('main-content')

    @if (Session::get('status') )
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Alert!</h4>
            {{ Session::get('status') }}
        </div>
    @endif

    <a href="/items_php/create" class="btn btn-success" role="button" aria-disabled="true">Create Item</a>

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Items:</h3>
        </div>
        <div class="box-body">
            <table class="table table-bordered table-hover table-striped">
                <tbody>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th style="width: 10px">Id</th>
                        <th>Task</th>
                        <th>Description</th>
                        <th style="width: 200px">Actions</th>
                    </tr>
                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $item->id}}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->description }}</td>
                            <td>
                                <form action="/items_php/{{ $item->id }}" method="POST">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="btn-group">
                                        <a href="/items_php/{{ $item->id}}" class="btn btn-info" role="button" aria-disabled="true">Show</a>
                                        <a href="/items_php/edit/{{ $item->id}}" class="btn btn-warning" role="button" aria-disabled="true">Edit</a>
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

    {{ Session::get('status') or '' }}
@endsection