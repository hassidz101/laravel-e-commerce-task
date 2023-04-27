<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Confirm</title>
</head>
<body>
<p>Order Id: {{$id}}</p>
<a href="{{route('order.confirm',[$faker_id])}}">Confirm Your Order</a>
</body>
</html>
