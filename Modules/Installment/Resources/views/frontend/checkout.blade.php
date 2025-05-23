<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ setting('app_name',locale()) }}</title>
    <link rel="shortcut icon" href="{{ setting('favicon') ? url(setting('favicon')) : '' }}"/>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #ffffff
        }

        .container {
            width: 600px;
            background-color: #fff;
            padding-top: 100px;
            padding-bottom: 100px
        }

        .card {
            background-color: #fff;
            width: 300px;
            border-radius: 15px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)
        }

        .name {
            font-size: 15px;
            color: #403f3f;
            font-weight: bold
        }

        .cross {
            font-size: 11px;
            color: #b0aeb7
        }

        .pin {
            font-size: 14px;
            color: #b0aeb7
        }

        .first {
            border-radius: 8px;
            border: 1.5px solid #78b9ff;
            color: #000;
            background-color: #eaf4ff
        }

        .second {
            border-radius: 8px;
            border: 1px solid #acacb0;
            color: #000;
            background-color: #fff
        }

        .dot {
        }

        .head {
            color: #137ff3;
            font-size: 12px
        }

        .dollar {
            font-size: 18px;
            color: #097bf7
        }

        .amount {
            color: #007bff;
            font-weight: bold;
            font-size: 18px
        }

        .form-control {
            font-size: 18px;
            font-weight: bold;
            width: 60px;
            height: 28px
        }

        .back {
            color: #aba4a4;
            font-size: 15px;
            line-height: 73px;
            font-weight: 400
        }

        .button {
            width: 150px;
            height: 60px;
            border-radius: 8px;
            font-size: 17px
        }
    </style>
</head>
<body>
<div class="container d-flex justify-content-center mt-5">
    <div class="card">
        <div>
            <div class="d-flex pt-3 pl-3">
                <div><img src="{{ setting('favicon') ? url(setting('favicon')) : '' }}" width="60" height="80"/></div>
                <div class="mt-3 pl-2"><span class="name">{{ setting('app_name',locale()) }}</span>
                </div>
            </div>
            <div class="py-2 px-3">
                <div class="first pl-2 d-flex py-2">
                    <div class="border-left pl-2"><span class="head">Total amount due</span>
                        <div><span class="dollar">KWD</span> <span class="amount">{{$transaction->amount}}</span></div>
                    </div>
                </div>
            </div>
            {!! Form::open([
                               'url'=> route('frontend.instalment.pay',[$transaction->token , $transaction->id]),
                               'id'=>'form',
                               'role'=>'form',
                               'method'=>'POST',
                               ])!!}
            <div class="d-flex justify-content-between px-3 pt-4 pb-3">
                <button type="submit" class="btn btn-primary button" id="submit_btn">
                    <span id="submit_word">
                                        Pay amount
                                    </span>
                    <span id="spinner" style="display: none">
                                    <span class="spinner-border spinner-border-md" role="status"
                                          aria-hidden="true"></span>
                </button>
            </div>
            {!! Form::close()!!}
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script>

    $('#form').on('submit', function (e) {
        $('#submit_btn').prop('disabled', true);
        $('#submit_word').hide();
        $('#spinner').show();
    });
</script>
</body>
</html>
