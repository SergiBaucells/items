
@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Item
@endsection

@section('contentheader_title')
    Item
@endsection


@section('main-content')
    <form action="/items_php/{{ $item->id }}" method="POST">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="btn-group">
            <a href="/items_php" class="btn btn-success" role="button" aria-disabled="true"> < Back</a>
            <a href="/items_php/edit/{{ $item->id}}" class="btn btn-warning" role="button" aria-disabled="true">Edit</a>
            <button type="submit" class="btn btn-danger">Delete</button>
        </div>
    </form>


    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Item:</h3>
        </div>
        <div class="box-body">
            <ul>
                <li>Id: {{ $item->id }}</li>
                <li>Name: {{ $item->name }}</li>
                <li>Description: {{ $item->description }}</li>
            </ul>
        </div>
    </div>
@endsection