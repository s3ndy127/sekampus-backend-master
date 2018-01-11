<td>
	@if (isset($entry->items))
		@foreach ($entry->items as $d)
			<ul>
				<li>
					{{ $d->merchant_name }}
				</li>
			</ul>
		@endforeach
	@endif
</td>