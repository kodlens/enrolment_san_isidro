@extends('layouts.admin')

@section('content')

    @if($id > 0)
        <manage-learner-create-edit
                prop-data='@json($data)'
                :prop-data-id="{{ $id }}"></manage-learner-create-edit>
    @else
         <manage-learner-create-edit
            prop-data=''
            :prop-data-id="0"></manage-learner-create-edit>
    @endif
    
@endsection

