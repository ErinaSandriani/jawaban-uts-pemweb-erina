<!DOCTYPE html>
<html>
<head>
    <title>Data Supir</title>
    <link rel="stylesheet" type="text/css" href="supir/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>
<body>
    
    <h1>Data Supir</h1>
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>No</th>
                <th>Alamat</th>
            </tr>
        </thead>
        <tbody>
            <!-- Loop through the supir data and display each row -->
            @foreach ($supirs as $supir)
                <tr>
                    <td>{{$supir->name}}</td>
                    <td>{{$supir->no}}</td>
                    <td>{{$supir->alamat}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

