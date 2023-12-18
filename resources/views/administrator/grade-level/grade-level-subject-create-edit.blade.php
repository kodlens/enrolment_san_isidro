@extends('layouts.admin')

@section('content')

    @if($id > 0)
        <grade-level-subject-create-edit
                prop-data='@json($data)'
                :prop-data-id="{{ $id }}"></grade-level-subject-create-edit>
    @else
        <grade-level-subject-create-edit
                prop-data=''
                :prop-data-id="{{ $id }}"></grade-level-subject-create-edit>
    @endif
   
@endsection

