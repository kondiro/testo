<div class=" custom-control custom-radio col-12 col-sm-2 {{ app()->getLocale() == 'ar' ? 'mr-2' : 'ml-2'}} ">
    <input type="radio" class="custom-control-input" value="{{ $value }}" id="{{ $id() }}" name="{{ $name }}"
           @if($checked)checked="checked"@endif>
    <label class="custom-control-label" for="{{ $id() }}">
        {{__($label)}}
    </label>
</div>
