<table {{ $attributes->merge(['class' => 'table table-stripped']) }}>
    @isset($thead)
        <thead>
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