@props([
'action' => '#',
'method' => 'POST',
'name' => '',
'formClass' => 'd-inline',
'buttonClass' => '',
'icon' => false,
])

<form method="POST" action="{{ $action }}" name="{{ $name }}" class="{{ $formClass }}">
    @csrf
    @method($method)

    <button type="submit" class="{{ $buttonClass }}">
        @if ($icon)<i class="{{ $icon }}"></i> @endif{{ $slot }}
    </button>
</form>
