@component('mail::layout')
{{-- Header --}}

@slot('header')
    <table align="center" width="570" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <a href="https://rothermel.com.br" style="margin: 30px">
                    <img src={{ $content['url_logo'] }}
                            alt="Logo Akhena" align="">
                </a>

            </td>
            <td class="header">
                <a href="https://rothermel.com.br">
                    Akhena<br><span> Ampliando Resultados com Tecnologia
                    <br><span>(51) 3377-8830</span>
                </a>
            </td>
        </tr>
    </table>
@endslot

{{-- Body --}}
#{{ $content['nome'] }}, Seja bem-vindo à Akhena:

Você está recebendo este email por ter se cadastrado no nosso site, logo entraremos em contato com você.

#### Aproveite para conhecer mais sobre nós:


@component('mail::button', ['url' => config('app.url').'/sobre'])
    {{ $content['button'] }}
@endcomponent
@component('mail::promotion')
    O seu contato deve ocorrer em até 48 horas.
@endcomponent


Att,<br>
{{ config('app.name') }}

{{-- Footer --}}
@slot('footer')
    @component('mail::footer')
        <br>
        <b class="footer">
            <a href="{{config('app.url').'/sobre'}}">Sobre</a> |
            <a href="{{config('app.url').'/contato'}}">Contato</a> | <a
                    href="{{config('app.url').'/admin'}}">Login</a> |
            <a href="{{config('app.url').'/descadastrar'}}">Descadastrar</a>
        </b>
        <br>&copy; {{ date('Y') }} {{ config('app.name') }}. Todos direitos reservados.
        <br>Ligue: (51) 3377-8830
    @endcomponent
@endslot
@endcomponent
