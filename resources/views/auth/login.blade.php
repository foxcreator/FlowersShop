<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('resources/sass/app.scss') }}">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <title>Document</title>
</head>
<body>
<div class="container">
    <div class="my"></div>
    <form class="col-6" action="{{ route('login.store') }}" method="POST">
        @csrf
        <div class="input-group flex-nowrap">
            {{ $errors->first('credential') }}
            <span class="input-group-text" id="addon-wrapping">@</span>
            <input type="text" name="credential" class="form-control" placeholder="Phone">
            @error('credential')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="input-group flex-nowrap">
            <span class="input-group-text" id="addon-wrapping">@</span>
            <input type="password" name="password" class="form-control" placeholder="Password">
            @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button class="btn btn-success">Submit</button>
    </form>
</div>
</body>
</html>
