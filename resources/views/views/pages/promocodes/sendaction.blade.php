<a href="#" class="btn btn-sm btn-icon btn-pure btn-default ladda-button btn-add" data-toggle="tooltip"  data-id="{{ $id }}"
   data-image="{{Storage::disk('public')->url('users/' . $image = empty($image) ? 'user.png' : $image)}}" data-name="{{$name}}"  data-email="{{$email}}" data-original-title="Add" data-plugin="ladda" data-style="zoom-in">
    <span class="ladda-label"><i class="icon wb-plus" aria-hidden="true"></i></span>
</a>
