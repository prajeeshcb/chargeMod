<a href="{{ route('promo-codes.edit', $id) }}" class="btn btn-sm btn-icon btn-pure btn-default ladda-button btn-edit" data-toggle="tooltip" data-original-title="Edit" data-plugin="ladda" data-style="zoom-in">
    <span class="ladda-label"><i class="icon wb-edit" aria-hidden="true"></i></span>
</a>
<a href="{{ route('promo-codes.destroy', $id) }}" class="btn btn-sm btn-icon btn-pure btn-default ladda-button btn-delete" data-toggle="tooltip" data-original-title="Delete"  data-style="zoom-in">
    <span class="ladda-label"><i class="icon wb-trash" aria-hidden="true"></i></span>
</a>
<a href="{{ route('promo-codes.selection', $id) }}" class="btn btn-sm btn-icon btn-pure btn-default ladda-button btn-send" data-toggle="tooltip" data-original-title="Send"  data-style="zoom-in">
    <span class="ladda-label"><i class="icon fa-send" aria-hidden="true"></i></span>
</a>