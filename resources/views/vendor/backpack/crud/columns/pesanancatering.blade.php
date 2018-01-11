<td>
	@if (isset($entry->items))
 		<p>
 			<span class="label label-success">Paket :</span><br>
				{{ $entry->catering['name'] }}
 		</p>
		@foreach ($entry->items as $d)

 			<p>
 			<span class="label label-success">Hari :</span><br>
				{{ $d->hari }}
 			</p>

 			<p>
 			<span class="label label-success">Menu :</span><br>
			<strong>
				Pagi :<br>
			</strong>
			@if (isset($d->pagi))
				@foreach ($d->pagi as $p)
					- {{ $p }}<br>
				@endforeach
			@else
			Tidak Ada Menu <br>
			@endif
			<strong>
				Siang :<br>
			</strong>
			@if (isset($d->siang))
				@foreach ($d->siang as $p)
					- {{ $p }}<br>
				@endforeach
			@else
			Tidak Ada Menu <br>
			@endif
			<strong>
				Malam :<br>
			</strong>
			@if (isset($d->malam))
				@foreach ($d->malam as $p)
					- {{ $p }}<br>
				@endforeach
			@else
			Tidak Ada Menu <br>
			@endif
 			</p>

		@endforeach
	@endif
</td>