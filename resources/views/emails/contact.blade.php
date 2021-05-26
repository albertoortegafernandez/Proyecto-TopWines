<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Correo</title>
</head>

<body>
    <img src="{{asset('img/new_logo.png')}}">
    <h1 style="text-align:center;">Pregunta para nuestro Sumiller</h1>

    <h3>Datos del Usuario</h3>
    <ul>
        <li><strong>Nombre:</strong>{{$contacto['name']}}</li>
        <li><strong>Apellidos:</strong>{{$contacto['surname']}}</li>
        <li><strong>Email:</strong>{{$contacto['email']}}</li>
    </ul>
    <h3>Pregunta</h3>
    <p>{{$contacto['msg']}}</p>
</body>

</html>