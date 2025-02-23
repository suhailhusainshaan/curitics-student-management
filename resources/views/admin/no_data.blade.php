<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>No Data Found</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'Arial', sans-serif;
            background-color: #e9ecef;
        }
        .container {
            text-align: center;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #dc3545; /* Bootstrap danger color */
            margin-bottom: 20px;
        }
        .home-button {
            padding: 12px 25px;
            font-size: 18px;
            color: #ffffff;
            background-color: #28a745; /* Bootstrap success color */
            border: none;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .home-button:hover {
            background-color: #218838; /* Darker green on hover */
        }
    </style>
</head>
<body>

<div class="container">
    <h1>NO DATA FOUND</h1>
    <a href="{{route('admin.dashboard')}}" class="home-button">Go to Home</a>
</div>

</body>
</html>