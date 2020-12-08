@extends('layouts.app')

@section('content')
<div class="container">
    <server_info :user="{{ auth()->user() }}"></server_info>
    

</div>
@endsection
