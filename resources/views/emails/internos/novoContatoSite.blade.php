@component('mail::message')
{{--<img src="{{ config('app.url').'/api/e/imagem/artigos/1b14ddc1e9f5bf1d9052a4adaac48ffc0529773c.jpg/600/0' }}">--}}

# Suporte informa:
@component('mail::promotion')
    {{ $content['body'] }}
@endcomponent

# {{ $content['title'] }}

**Nome:** {{ $content['nome'] }}
<br>
**Empresa:** {{ $content['empresa'] }}
<br>
**Cargo:** {{ $content['cargo'] }}
<br>
**Email:** {{ $content['email'] }}
<br>
**Assunto:** {{ $content['assunto'] }}
<br>
**Mensagem:** {{ $content['mensagem'] }}
<br>
**Código Contato:** {{ $content['contato_id'] }}

@component('mail::button', ['url' => ($content['url_button']) ? $content['url_button'] : config('app.url').'/admin'])
    {{ $content['button'] }}
@endcomponent

@component('mail::panel')
Este usuário pode ser administrado na área administrativa do site Akhena
@endcomponent

{{--@component('mail::table')--}}
    {{--| Laravel       | Table         | Example  |--}}
    {{--| ------------- |:-------------:| --------:|--}}
    {{--| PHP           | Centered      | $100     |--}}
    {{--| Laravel       | Right-Aligned | $200     |--}}
{{--@endcomponent--}}

@component('mail::promotion')
    O contato com o cliente deve ocorrer em até 48 horas.
@endcomponent

Att,<br>
{{ config('app.name') }}
@endcomponent
