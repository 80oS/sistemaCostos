<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .preloader {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            width: 100%;
            background: linear-gradient(90deg, #c1c1c1, #021e81) !important;
        }
        body {
            background: linear-gradient(90deg, #c1c1c1, #021e81) !important;
        }
    </style>
</head>
<body>
    <div class="preloader">
        <div class="loader">
            <l-quantum
                size="80"
                speed="1.5"
                color="#fff" 
            ></l-quantum>
        </div>
    </div>
    <script type="module" src="https://cdn.jsdelivr.net/npm/ldrs/dist/auto/quantum.js"></script>
</body>
</html>