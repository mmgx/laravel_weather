<form method="get" {{ $attributes->merge(['action' => '#', 'class' => 'form-horizontal']) }}>
    @csrf

    {{ $slot }}
</form>
