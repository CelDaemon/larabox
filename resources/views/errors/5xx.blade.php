@use('Illuminate\Http\Response')
@extends('errors::minimal')

@section('title', __('Something Went Wrong'))
@section('code', $exception->getStatusCode())
@section('message', __(Response::$statusTexts[$exception->getStatusCode()]))
