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
    <form class="col-6" action="{{ route('register.store') }}" method="POST">
        @csrf
        <div class="input-group flex-nowrap">
            <span class="input-group-text" id="addon-wrapping">@</span>
            <input type="text" name="name" class="form-control" placeholder="Username">
        </div>
        <div class="input-group flex-nowrap">
            <span class="input-group-text" id="addon-wrapping">@</span>
            <input type="text" name="last_name" class="form-control" placeholder="Last name">
        </div>
        <div class="input-group flex-nowrap">
            <span class="input-group-text" id="addon-wrapping">@</span>
            <input type="text" name="phone" class="form-control" placeholder="Phone">
        </div>
        <div class="input-group flex-nowrap">
            <span class="input-group-text" id="addon-wrapping">@</span>
            <input type="email" name="email" class="form-control" placeholder="Email">
        </div>
        <div class="input-group flex-nowrap">
            <span class="input-group-text" id="addon-wrapping">@</span>
            <input type="password" name="password" class="form-control" placeholder="Password">
        </div>
        <div class="input-group flex-nowrap">
            <span class="input-group-text" id="addon-wrapping">@</span>
            <input type="password" name="password_confirmation" class="form-control" placeholder="Password confirmed">
        </div>

        <button class="btn btn-success">Submit</button>
    </form>
</div>
</body>
</html>
