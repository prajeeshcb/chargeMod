@extends('layouts.app')

@section('content')
<div class="container">
    <serverview :user="{{ auth()->user() }}"></serverview>
    
</div>
@endsection
