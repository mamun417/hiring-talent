<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Message</title>
</head>
<body>
    <h2><strong>User Name: </strong>{{ $email_details['name'] }}</h2>
    <hr>
    <p><strong>Email: </strong>{{ $email_details['email'] }}</p>
    <p><strong>Subject: </strong>{{ $email_details['subject'] }}</p>
    <hr>
    <p><strong>Message Body: </strong>{{ $email_details['message'] }}</p>
</body>
</html>