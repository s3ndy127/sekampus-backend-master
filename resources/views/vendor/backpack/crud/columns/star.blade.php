<td>
	@php
		$count = $entry->rating;
	@endphp

	@for ($i = 1; $i <= $count; $i++)
		<span class="fa fa-star"></span>
	@endfor
</td>