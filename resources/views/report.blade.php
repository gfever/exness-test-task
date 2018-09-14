<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

    <link rel="stylesheet" media="all"
          href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css"/>

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="title m-b-md">
        Report
    </div>
    <form action="" method="GET" style="margin-bottom: 20px;">
        <div class="form-group">
            <label for="user_name">User name</label>
            <input type="text" class="form-control" id="user_name" name="user_name" required value="Brennon McDermott"/>
        </div>

        <div class="form-group">
            <label for="from_date">From date</label>
            <input type="text" class="form-control" id="from_date" name="from_date"/>
        </div>

        <div class="form-group">
            <label for="to_date">To date</label>
            <input type="text" class="form-control" id="to_date" name="to_date"/>
        </div>

        <input type="submit" name="report" class="btn btn-default">

    </form>


    <p class="h5">Operations total {{$sumInUserCurrency}}</p>
    <p class="h5">Operations total in USD {{$sunInUsd}}</p>
    <a href="{{$_SERVER['REQUEST_URI']}}&download=1" class="btn-success btn" style="margin-bottom: 10px">Download
        report</a>
    <table id="report" class="table-dark table">
        <thead>
        <th scope="col">id</th>
        <th scope="col">amount</th>
        <th scope="col">operation</th>
        <th scope="col">created_at</th>
        </thead>
        <tbody>
        @foreach ($transactions as $transaction)

            <tr>
                <th scope="row">{{$transaction->id}}</th>
                <td>{{$transaction->amount}}</td>
                <td>{{$transaction->operation}}</td>
                <td>{{$transaction->created_at}}</td>
            </tr>

        @endforeach
        </tbody>
    </table>


</div>

</body>
</html>
