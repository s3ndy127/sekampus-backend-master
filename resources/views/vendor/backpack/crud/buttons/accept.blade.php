@if ($crud->hasAccess('accept'))
	@if(is_null($entry->payment))
	@elseif($entry->payment->status == 1)
			<a href="{{ url($crud->route.'/'.$entry->invoice . '/accept') }}" class="btn btn-xs btn-success" data-button-type="accept"><i class="fa fa-check"></i> Terima</a>
	@elseif($entry->payment->status == 3)
			<a href="{{ url($crud->route.'/'.$entry->invoice . '/finish') }}" class="btn btn-xs btn-primary" data-button-type="accept"><i class="fa fa-check"></i> Selesaikan</a>
	@else
	@endif
@endif