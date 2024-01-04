@extends('layouts.teacher')

@section('content')
    <grade-entry-page
        :prop-academic-year-id="{{ $ayId }}"
        :prop-section-id="{{ $sectionId }}"
        :prop-subject-id="{{ $subjectId }}"
        :prop-enroll-id="{{ $enrollId }}"></grade-entry-page>
@endsection

