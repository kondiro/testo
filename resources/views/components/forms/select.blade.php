@push('plugin-styles')
    <style>
        .select2 {
            margin-bottom: 0 !important;
        }


    </style>

@endpush
<div class="form-group row">
    <label class="col-12 col-sm-3 col-form-label"
           for={{ $name }}>
        {{ $label }}
        @if($required || $attributes->has('required'))
            <span class="text-danger">*</span>
        @endif
    </label>
    <div class="col-12 col-sm-9">
        <select
            {!! $attributes !!}
            {{ $required  ? 'required'  : ''}}
            {{ $readonly  ? 'readonly'  : ''}}
            id="{{ $name }}"
            class="custom-select basic"
            name={{ $name }}>

            @if(!$isModelExists() && old($name) === null)
                <option value="" selected  @if($required || $attributes->has('required')) disabled @endif >
                    {{ __('globals.choisir') }}
                </option>

            @else
                <option value="" @if($required || $attributes->has('required')) disabled @endif>
                    {{ __('globals.choisir') }}
                </option>
            @endif


            @if(isset($options))
                @foreach($options as $key => $option)
                    @if($isModelExists() &&  old($name))
                        <option
                            {{ old($name) === $key ? 'selected' : '' }}  value={{$key}}>{{ $option }}</option>
                    @else
                        @if($isModelExists())
                            <option
                                {{ $column() === $key ? 'selected' : '' }}  value={{$key}}>{{ $option }}</option>
                        @elseif( old($name)  )
                            <option
                                {{ old($name) === $key ? 'selected' : '' }}  value={{$key}}>{{ $option }}</option>
                        @else
                            <option value={{$key}} >{{ $option }}</option>
                        @endif
                    @endif

                @endforeach
            @elseif(isset($table))
                @php($columns = $table[1])
                @foreach($table[0] as $record)
                    @if($isModelExists() && old($name))
                        <option
                            {{ old($name) == $record[$columns[0]] ? 'selected' : '' }}
                            value="{{$record[$columns[0]]}}">{{$record[$columns[1]]}} </option>
                    @else
                        @if($isModelExists())
                            <option
                                {{ $column() == $record[$columns[0]] ? 'selected' : '' }}
                                value="{{$record[$columns[0]]}}">{{$record[$columns[1]]}} </option>
                        @elseif( old($name) !== null )
                            <option
                                {{ old($name) == $record[$columns[0]]  ? 'selected' : '' }}
                                value="{{$record[$columns[0]]}}">{{$record[$columns[1]]}} </option>
                        @else
                            <option
                                value="{{$record[$columns[0]]}}">{{$record[$columns[1]]}} </option>
                        @endif
                    @endif
                @endforeach
            @endif
        </select>
        <x-alerts.error-message>
            @error($name)
            {{$message}}
            @enderror
        </x-alerts.error-message>
    </div>
</div>


