<td>
@if(is_null($entry->payment))
	<span class="label label-danger">Belum Dibayar</span>
@elseif($entry->payment->status == 0)
	<span class="label label-danger">Belum Dibayar</span>
@elseif($entry->payment->status == 1)
	<span class="label label-warning">Perlu Konfirmasi</span>
@elseif($entry->payment->status == 2)
	<span class="label label-primary">Sedang Diproses</span>
@elseif($entry->payment->status == 3)
	<span class="label label-primary">Pesanan Dikonfirmasi Pengguna</span>
@else
	<span class="label label-success">Pesanan Selesai</span>
@endif
</td>