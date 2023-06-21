<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <title>New Lead</title>
</head>
<body>
    <h1>Ciao Admin!</h1>
        <p>Hai ricevuto un nuovo messaggio!  </p>     
        <p>
            Nome: {{$lead->name}}  <br>
            Email: {{$lead->email}} <br>
            Message: <br>
             {{$lead->message}}
        </p>
</body>
</html>