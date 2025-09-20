<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite('resources/css/app.css')

    <script src="https://unpkg.com/lucide@latest"></script>

    <title>{{$title}} - Select A Room</title>
</head>

<body>
    @include('booking.component.nav');

    <section class="container mx-auto px-4 py-8 mt-10">

        <livewire:room-landing />

    </section>

    @include('booking.terms')
    @include('landing.footer')




</body>

<script type="module">
    import lucide from 'https://unpkg.com/lucide@latest/dist/esm/lucide.js';
    lucide.createIcons();
</script>


@include('javascriptfix.soliera_js')

<script src="{{asset('javascript/photouploadglobal.js')}}"></script>

</html>