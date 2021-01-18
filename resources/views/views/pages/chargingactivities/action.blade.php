@if($status == 'stop_initiated')
    <form method="post" action="{{ route('charging-activities.update', $id) }}">
        @csrf
        @method('PUT')
        <button type="submit" class="btn btn-danger">Force Stop</button>
    </form>
@endif
