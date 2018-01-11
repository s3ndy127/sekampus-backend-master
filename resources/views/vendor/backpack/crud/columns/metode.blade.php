<td>
@if(is_null($entry->payment))
	<span class="label label-danger">Belum Dibayar</span>
@else
	<span class="label label-success">{{ strtoupper($entry->payment->payment_type) }}</span>
@endif
</td>