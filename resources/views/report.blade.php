<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <script type='text/javascript' src='https://s3.amazonaws.com/dynatable-docs-assets/js/jquery-1.9.1.min.js'></script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

    <link rel="stylesheet" media="all" href="https://s3.amazonaws.com/dynatable-docs-assets/css/jquery.dynatable.css" />


    <script type='text/javascript' src='https://s3.amazonaws.com/dynatable-docs-assets/js/jquery.dynatable.js'></script>


    <link rel="stylesheet" media="all" href="https://s3.amazonaws.com/dynatable-docs-assets/css/reset.css" />
    <link rel="stylesheet" media="all" href="https://s3.amazonaws.com/dynatable-docs-assets/css/bootstrap-2.3.2.min.css" />
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
<script>
    var getUrlParameter = function getUrlParameter(sParam) {
        var sPageURL = decodeURIComponent(window.location.search.substring(1)),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : sParameterName[1];
            }
        }
    };

    $(document).ready(function () {

        $('#my-ajax-table').dynatable({
            dataset: {
                ajax: true,
                ajaxUrl: '/transaction?user_name=' + getUrlParameter('user_name') + '&from_date=' + getUrlParameter('from_date') + '&to_date=' + getUrlParameter('to_date'),
                ajaxOnLoad: true,
                records: []
            }
        });
    })


</script>
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title m-b-md">
            Report
        </div>

        <form action="" method="GET">
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

        <table id="my-ajax-table" class="table">
            <thead>
            <th>Some Attribute</th>
            <th>Some Other Attribute</th>
            </thead>
            <tbody>
            </tbody>
        </table>


    </div>
</div>
</body>
</html>
