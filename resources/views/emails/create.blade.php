<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Todo create notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f1f1f1;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            max-width: 200px;
        }

        .message {
            padding: 20px;
            background-color: #ffffff;
        }

        .message p {
            margin-bottom: 10px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        
        <div class="message">
            <p>Dear {{ $mailData['name'] }},</p>
            <p>You have created a new todo using our web app.</p>
            <p>Todo name :{{ $mailData['todo'] }}</p>
            <p>Created at :{{ $mailData['createdAt'] }}</p>
            <p>image: </p>
            <img class="rounded w-10 h-10 mt-5 block" 
            src="{{ env('APP_URL')}}/storage/{{ $mailData['image'] }}" alt="" width="50" height="50">
        </div>
        
    </div>
</body>

</html>