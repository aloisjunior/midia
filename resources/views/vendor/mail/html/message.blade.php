@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            Akhena<br><span> Ampliando Resultados com Tecnologia </span>
        @endcomponent
    @endslot

    {{-- Body --}}
    {{ $slot }}

    {{-- Subcopy --}}
    @isset($subcopy)
        @slot('subcopy')
            @component('mail::subcopy')
                {{ $subcopy }}
            @endcomponent
        @endslot
    @endisset

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            <br>
            <b class="footer">
                <a href="{{config('app.url').'/sobre'}}">Sobre</a>  |
                <a href="{{config('app.url').'/contato'}}">Contato</a>  |  <a href="{{config('app.url').'/admin'}}">Login</a>  |
                <a href="{{config('app.url').'/descadastrar'}}">Descadastrar</a>
            </b>
            <br>&copy; {{ date('Y') }} {{ config('app.name') }}. Todos direitos reservados.
            <br>Ligue: (51) 3377-8830
        @endcomponent
    @endslot
@endcomponent
