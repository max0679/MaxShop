@if($category_properties)

    @foreach($category_properties as $property_column => $property_title)

        <div class="form-group">
            <label for="{{ $property_column }}">{{ $property_title }}</label>
            <input type="text" name="{{ $property_column }}" class="form-control @error("property_column") is-invalid @enderror" value="{{ old("property_column") }}" placeholder="{{ $property_title }}">
            @error("property_column")
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

    @endforeach

@endif
