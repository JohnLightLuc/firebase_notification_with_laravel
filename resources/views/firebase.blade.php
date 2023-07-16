<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>

    <div class="container" style="margin-top: 30px;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                 <div class="row">
                    <div class="col-md-7">
                        <select name="customer" id="customertoken" class="form-control">
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->first_name }} {{ $customer->last_name }}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="col-md-5">
                        <button onclick="startFCM()" id="allow"
                            class="btn btn-danger btn-flat">Allow notification
                        </button>

                    </div>



                 </div>

                <div class="card mt-3">
                    <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                        <form action="{{ route('customer-notifications.store')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Customer</label>
                                {{-- <input type="text" class="form-control" name="title"> --}}
                                <select name="customer_id" class="form-control">
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->first_name }} {{ $customer->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Message Title</label>
                                <input type="text" class="form-control" name="title">
                            </div>
                            <div class="form-group">
                                <label>Message Body</label>
                                <textarea class="form-control" name="body"></textarea>
                            </div>
                            <button type="submit" class="btn btn-success btn-block">Send Notification</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>


    {{-- <script type="module">
        // Import the functions you need from the SDKs you need
        import {initializeApp } from "https://www.getstatic.com/firebasejs/10.0.0/firebase-app.js";

        // Your web app's Firebase configuration
        const firebaseConfig = {
            apikey : "AIzaSyDU4yErYGZ5S0gR95StmaXOnBx8Uw0yqEs",,
            authDomain: "cheznous-fa08f.firebaseapp.com",
            projectId : "cheznous-fa08f",
            storageBucket: "cheznous-fa08f.appspot.com",
            messagingSenderId: "513476528003",
            appId: "1:513476528003:web:82b80f1982f38157f098b6"
        };

        // Initialise Firebase
        const app = initializeApp(firebaseConfig);
    </script> --}}

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>
    <script>
        const firebaseConfig = {
            apikey : "AIzaSyDU4yErYGZ5S0gR95StmaXOnBx8Uw0yqEs",
            authDomain: "cheznous-fa08f.firebaseapp.com",
            projectId : "cheznous-fa08f",
            storageBucket: "cheznous-fa08f.appspot.com",
            messagingSenderId: "513476528003",
            appId: "1:513476528003:web:82b80f1982f38157f098b6"
        };

        firebase.initializeApp(firebaseConfig);
        const messaging = firebase.messaging();
        function startFCM() {
            messaging
                .requestPermission()
                .then(function () {
                    return messaging.getToken()
                })
                .then(function (response) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '{{ route("customer-devices.store") }}',
                        type: 'POST',
                        data: {
                            customer_id: document.getElementById('customertoken').value,
                            firebase_id: response
                        },
                        dataType: 'JSON',
                        success: function (response) {
                            console.log(response);
                            alert('Token stored.');
                        },
                        error: function (error) {
                            alert(error);
                        },
                    });
                }).catch(function (error) {
                    alert(error);
                });
        }
        messaging.onMessage(function (payload) {
            const title = payload.notification.title;
            const options = {
                body: payload.notification.body,
                icon: payload.notification.icon,
            };
            new Notification(title, options);
        });
    </script>
</body>
</html>
