<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ $data['title']}}</title>
</head>
<body>

    <table>
        <tr>
            <th>Name</th>
            <th>{{ $data['name']}}</th>
        </tr>
        <tr>
            <th>Email</th>
            <th>{{ $data['email']}}</th>
        </tr>
        <tr>
            <th>Password</th>
            <th>{{ $data['password']}}</th>
        </tr>
    </table>

    <a href="{{ $data['url']}}">Klick disini untuk login ke akun anda</a>
    <p>Terima Kasih!</p>
    
</body>
</html>