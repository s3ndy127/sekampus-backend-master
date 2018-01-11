<td>
	@if (isset($entry->items))
		@foreach ($entry->items as $d)

 			<p>
 			<span class="label label-success">Menu :</span><br>
			<strong>
				{{ $d->nama_makanan }}
			</strong>
 			</p>

			<p>
			<span class="label label-primary">
				Merchant :
			</span><br>
			<strong>
				{{ $d->merchant_name }}
			</strong>
			({{$d->merchant_phone }})
			</p>

			<p>
			<span class="label label-default">
				Waktu Kirim :
			</span><br>
			<strong>
				{{ date('d M Y', strtotime($entry->tanggal_kirim)) }},
				{{ $d->waktu_kirim }}
			</strong>
			</p>
			<hr>
		@endforeach
	@endif
</td>