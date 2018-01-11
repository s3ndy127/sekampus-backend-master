<td>
	@if (isset($entry->menu))
	@foreach ($entry->menu as $d)
	<ul>
		<li>
			<strong>Hari : {{ $d->hari }}</strong>
			<div class="pull-right">
				<a href="{{ URL::route('crud.menu.edit', ['menu' => $d->id]) }}">
					<span class="fa fa-pencil-square-o"></span>
				</a>
				<a href="{{ URL::route('crud.menu.delete', ['menu' => $d->id]) }}">
					<span class="fa-close" style="color: red;"></span>
				</a>
			</div>
		</li>
		<strong>Menu Pagi : </strong>
		<ol>
			@if (isset($d->pagi))
			@foreach ($d->pagi as $p)
			<li>
				{{ $p }}
			</li>
			@endforeach
			@else
			{{ 'Tidak Ada Menu' }}
			@endif
		</ol>
		<strong>Menu Siang : </strong>
		<ol>
			@if (isset($d->siang))
			@foreach ($d->siang as $p)
			<li>
				{{ $p }}
			</li>
			@endforeach
			@else
			{{ 'Tidak Ada Menu' }}
			@endif
		</ol>
		<strong>Menu Malam : </strong>
		<ol>
			@if (isset($d->malam))
			@foreach ($d->malam as $p)
			<li>
				{{ $p }}
			</li>
			@endforeach
			@else
			{{ 'Tidak Ada Menu' }}
			@endif
		</ol>
	</ul>
	@endforeach
	@endif
</td>