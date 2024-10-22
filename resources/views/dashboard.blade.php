<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard con Calendario</title>
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.css' rel='stylesheet' />
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }
        .dashboard {
            display: flex;
            height: 110vh;
        }
        .sidebar {
            width: 200px;
            background-color: #333;
            color: white;
            padding: 20px;
        }
        .main-content {
            flex-grow: 1;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 110vh;
        }
        h1, h2 {
            margin-top: 0;
        }
        #calendar {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 800px;
            height: 500px;
        }
        #eventForm {
            margin-top: 20px;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        input, button {
            margin: 10px 0;
            padding: 5px;
            width: 100%;
        }
        .selected-event {
            background-color: #e8d420 !important;
        }
        #deleteBtn {
            background-color: red;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: none; /* Solo se mostrará si hay eventos seleccionados */
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Dashboard</h2>
        <nav>
            <ul>
                <li><a href="{{ route('home') }}" style="color: white;">home</a></li>
            </ul>
        </nav>
    </div>
</body>
</html>