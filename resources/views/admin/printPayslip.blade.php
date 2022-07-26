<!DOCTYPE html>

<head>
    <title>Pusher Test</title>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('7604f23f5c12ed7e6dd7', {
            cluster: 'ap2'
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {
            $("#payslipButton").trigger("click");
        });
    </script>
</head>

<body>
    <h1>Pusher Test</h1>
    <p>
        Try publishing an event to channel <code>my-channel</code>
        with event name <code>my-event</code>
        <a href="{{ Url('downloadPayslip/index') }}"><button class="btn btn-success" id="payslipButton"> Button</button></a>
    </p>
</body>
