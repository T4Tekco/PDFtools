<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="container" style="display: flex; ">
        <div class="box_qr" style="margin: 0 auto">
    <img src="http://localhost:8000/{{$qrcode}}" alt="">
    <a href="{{ route('downloadQRCode') }}?filename={{$fileName}}">dowload</a>
    <a href="{{ route('home') }}">home</a>
        </div>
    </div>
</body>
</html>