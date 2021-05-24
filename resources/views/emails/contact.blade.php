<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Correo</title>
</head>
<body>
    <h1>Pregunta de Usuario para  nuestro Sumiller</h1>
    
    <p><strong>Nombre:</strong>{{$contacto['name']}}</p>
    <p><strong>Apellidos:</strong>{{$contacto['surname']}}</p>
    <p><strong>Email:</strong>{{$contacto['email']}}</p>
    <p><strong>Mensaje:</strong>{{$contacto['msg']}}</p>
</body>
</html>