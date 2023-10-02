@extends('layouts.admin')

@section('content')

    @if($id > 0)
        <enrollee-create-edit
                prop-data='@json($data)'
                :prop-data-id="{{ $id }}"></enrollee-create-edit>
    @else
        <enrollee-create-edit
                prop-data=''
                :prop-data-id="{{ $id }}"></enrollee-create-edit>
    @endif
   
@endsection

