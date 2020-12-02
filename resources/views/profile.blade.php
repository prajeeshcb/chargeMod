@extends('layouts.app')

@section('content')
<div class="container">
    <!-- <chats :user="{{ auth()->user() }}"></chats> -->
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header"><strong>EV Authentication</strong> </div>

                <div class="card-body">
                    <form method="POST" action="">
                        @csrf

                        <div class="form-group">
                        	<label>ID Tag</label>

                            <!-- <div class="col-md-6"> -->
                                <input id="idTag" type="idTag" class="form-control @error('idTag') is-invalid @enderror" name="idTag" value="{{ old('idTag') }}" required autocomplete="ID Tag" autofocus>

                                @error('idTag')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            <!-- </div> -->

                        </div>
                        <div class="form-group">
                        	<center><button type="submit" class="btn btn-primary" >
                                    {{ __('Submit') }}
                                </button></center>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
