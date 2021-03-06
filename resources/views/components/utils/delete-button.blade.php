@props(['href' => '#', 'text' => __('Delete')])

<x-utils.form-button
    :action="$href"
    method="delete"
    name="delete-item"
    button-class="btn btn-danger btn-sm"
>
    <i class="fas fa-trash"></i> {{ $text }}
</x-utils.form-button>
