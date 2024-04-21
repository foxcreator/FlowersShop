@extends('mails.layout')
@section('content')
    <table class="content" width="100%">
        <tr>
            <td>
                <p>Ви отримали цей лист, тому що ми отримали запит на скидання пароля для вашого облікового запису.</p>
            </td>
        </tr>
        <tr style="height: 40px"></tr>
        <tr>
            <td class="button">
                <p><a href="{{ $url }}">Скинути пароль</a></p>
            </td>
        </tr>
        <tr style="height: 40px"></tr>
        <tr>
            <td class="button">
                <p>Це посилання для скидання пароля стане недійсним через {{ config('auth.passwords.'.config('auth.defaults.passwords').'.expire') }} хвилин.</p>
                <p>Якщо ви не надсилали запит на скидання пароля, то інші дії не потрібні.</p>
            </td>
        </tr>

    </table>
@endsection
