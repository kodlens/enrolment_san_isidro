@extends('layouts.print-layout')

@section('content')
    <coe-index 
        :prop-learner-id="{{ $learnerId }}"
        :prop-academic-year-id="{{ $ayId }}"></coe-index>
@endsection

