<table {{ $attributes->merge(['class' => 'table table-stripped']) }}>
    @isset($thead)
        <thead class="bg-primary">
            {{ $thead }}
        </thead>
    @endisset

    {{ $slot }}

    @isset($tfoot)
        <tfoot>
            {{ $tfoot }}
        </tfoot>
    @endisset

</table>