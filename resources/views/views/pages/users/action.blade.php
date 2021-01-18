<div class="text-right">
    @if ($status == \App\Models\ChargingActivity::STATUS_STOPPED || $status == null)
        <a href="#" class="text-success a-start" data-user-id="{{ $query->id }}" style="text-decoration: none">START</a>
    @elseif ($status == \App\Models\ChargingActivity::STATUS_START_INITIATED || $status == \App\Models\ChargingActivity::STATUS_STARTED || $status == \App\Models\ChargingActivity::STATUS_STOP_INITIATED)
        <a href="{{ url('charging-activities/stop', $query->chargingActivities()->latest()->first()->id) }}" class="text-danger a-stop" style="text-decoration: none">STOP</a>
    @else
    @endif

    <a href="{{ route('users.show', $query->id) }}" class="btn btn-sm btn-icon btn-pure btn-default ladda-button btn-show" data-toggle="tooltip" data-original-title="Show"  data-style="zoom-in">
        <span class="ladda-label"><i class="icon wb-eye" aria-hidden="true"></i></span>
    </a>
    <a href="{{ route('users.status-update', ['id' => $query->id,'status' => $query->status]) }}" data-status="{{ $query->status }}" class="btn btn-sm btn-icon btn-pure btn-default ladda-button btn-edit" data-toggle="tooltip" data-original-title="Edit" data-plugin="ladda" data-style="zoom-in">
        <span class="ladda-label"><i class="icon wb-edit" aria-hidden="true"></i></span>
    </a>
    <a href="{{ route('users.destroy', $query->id) }}" class="btn btn-sm btn-icon btn-pure btn-default ladda-button btn-delete" data-toggle="tooltip" data-original-title="Delete"  data-style="zoom-in">
        <span class="ladda-label"><i class="icon wb-trash" aria-hidden="true"></i></span>
    </a>
</div>
