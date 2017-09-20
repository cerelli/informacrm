@if (isset($field['wrapperAttributes']))
    @foreach ($field['wrapperAttributes'] as $attribute => $value)
    	@if (is_string($attribute))
        {{ $attribute }}="{{ $value }}"
        @endif
    @endforeach

    @if (!isset($field['wrapperAttributes']['class']))
		class="form-group col-md-12"
    @endif
    {{-- {{ dump($attribute) }} --}}
@else
	class="form-group col-md-12"
@endif
