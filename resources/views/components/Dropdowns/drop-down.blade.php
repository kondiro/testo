
<div class='ms-auto d-flex justify-content-between'>
    <div class='btn-group'>
        <button type='button' class='btn btn-light'>{{ $label }}</button>
        <button type='button' class='btn btn-light dropdown-toggle dropdown-toggle-split' data-bs-toggle='dropdown'>
            <span class='visually-hidden'>Toggle Dropdown</span>
        </button>
        <div class='dropdown-menu '>
            @foreach($actions as $action => $route)
                <a class='dropdown-item' href='{{ $route }}'>{{ ucfirst($action) }}</a>
            @endforeach
        </div>
    </div>
</div>
