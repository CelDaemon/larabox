@use('Illuminate\Http\Response')
@extends('errors::minimal')

@section('title', __(Response::$statusTexts[$exception->getStatusCode()]))
@section('code', $exception->getStatusCode())
@section('message', __(Response::$statusTexts[$exception->getStatusCode()]))
