<table align="center" width="570" cellpadding="0" cellspacing="0">
    <tr>
        <td>
            <a href="{{ $url }}" style="margin: 30px">
                <img src={{ env('APP_URL').'/api/e/mail/image/opened/arquivos/36c7bed8c26dbae7c50c474d8b0f3e9ba2ab6947.png/130/0' }}
                     alt="Logo Akhena" align="">
            </a>

        </td>
        <td class="header">
            <a href="{{ $url }}">
                {{ $slot }}
                <br><span>(51) 3377-8830</span>
            </a>
        </td>
    </tr>
</table>
