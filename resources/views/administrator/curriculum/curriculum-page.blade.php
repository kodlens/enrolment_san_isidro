
@extends('layouts.admin')

@section('content')
    <curriculum-page 
        :prop-id="{{ $id }}" 
        :prop-data='@json($data)'></curriculum-page>
@endsection

