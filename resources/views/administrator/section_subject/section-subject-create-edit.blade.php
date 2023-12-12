@extends('layouts.admin')

@section('content')

    @if($id > 0)
        <section-subject-create-edit
                prop-data='@json($data)'
                :prop-data-id="{{ $id }}"></section-subject-create-edit>
    @else
        <section-subject-create-edit
                prop-data=''
                :prop-data-id="{{ $id }}"></section-subject-create-edit>
    @endif
   
@endsection

