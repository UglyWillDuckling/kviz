@extends('errors::layout')

@section('title', 'Page Not Found')

@if($exception->getMessage())
@section('message', $exception->getMessage())
@else
    @section('message', 'Sorry, the page you are looking for could not be found.')
@endif
