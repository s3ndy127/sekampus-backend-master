<td>
  @if( !empty($entry->payment->image) )
    <a
      href="{{ asset($entry->payment->image) }}"
      target="_blank"
    >
      <img
        src="{{ asset($entry->payment->image) }}"
        style="
          max-height: {{ isset($column['height']) ? $column['height'] : "25px" }};
          width: {{ isset($column['width']) ? $column['width'] : "auto" }};
          border-radius: 3px;"
      />
    </a>
  @else
    -
  @endif
</td>
