@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Items list
@endsection

@section('main-content')
    <h1>Edit Item:</h1>
    <form action="/items/{{ $item->id }}" method="POST">
        <input type="hidden" name="_method" value="PUT">
        {{ csrf_field() }}
        <input type="text" name="name" value="{{ $item->name }}" placeholder="Name">
        <textarea name="description" id="description" cols="30" rows="10" placeholder="Put your description here">{{ $item->description }}</textarea>
        <input type="submit" value="Update">
    </form>
@endsection
