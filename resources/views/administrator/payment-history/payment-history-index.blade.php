@extends('layouts.admin')

@section('content')
    <payment-history-index :prop-id="{{$learner_id}}"
        :prop-data='@json($payments)'></payment-history-index>
@endsection

