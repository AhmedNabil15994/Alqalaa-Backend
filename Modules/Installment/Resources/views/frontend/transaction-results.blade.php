<html>
<head>
    <title>@yield('title', '--') || {{ setting('app_name',locale()) }}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <link rel="shortcut icon" href="{{ setting('favicon') ? url(setting('favicon')) : '' }}"/>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="/admin/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
</head>
<style>
    body {
        font-family: 'Cairo', sans-serif;
        text-align: center;
        padding: 40px 0;
        background: #EBF0F5;
    }

    h1 {
        color: #88B04B;
        font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
        font-weight: 900;
        font-size: 40px;
        margin-bottom: 10px;
    }

    p {
        color: #404F5E;
        font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
        font-size: 20px;
        margin: 0;
    }

    i ,a{
        color: #9ABC66;
    }

    .card {
        background: white;
        padding: 60px;
        border-radius: 4px;
        box-shadow: 0 2px 3px #C8D0D8;
        display: inline-block;
        margin: 0 auto;
    }
</style>

<body>
<div class="card">
    <div style="border-radius:200px; padding:52px 0px; width:200px; background: #F8FAF5; margin:0 auto;">

        <img src="{{asset('uploads/payment_status_'.$transaction['status'].'.png')}}" style="max-width: 80px;">
    </div>
    @php
        switch ($transaction['status']){
        case 1:
        $color = '#9ABC66';
        break;
        case 2:
        $color = '#ffd403';
        break;
        default:
        $color = '#e74729';
        break;
        }
    @endphp
    <h1 style="color: {{$color}};margin-top: 36px;">{{$transaction['msg']}}</h1>
    @if($transaction['status'] == 1 && $transaction['data'])
        <table class="table">
            <thead>
            <tr>
                <th scope="col" class="text-center">#</th>
                <th scope="col" class="text-center">{{__('installment::dashboard.installments.datatable.paid_amount')}}</th>
                <th scope="col" class="text-center">Print</th>
            </tr>
            </thead>
            <tbody>
            @foreach($transaction['data']->instalments as $instalment)

                <tr>
                    <th scope="row" class="text-center">
                        {{$instalment->id}}
                    </th>
                    <td class="text-center">
                        {{$instalment->pivot->amount}}
                    </td>
                    <td class="text-center">
                        <button onclick="printFromUrl('{{route('installments.print',$instalment->id)}}')" target="_blank" class="btn btn-success"><i class="fa fa-print"></i></a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    @endif
    <a class="btn btn-primary" style="color: white" href="{{route('frontend.home')}}">Home Page</a>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>


function printFromUrl(url) {
    
       
    $("<iframe>").hide().attr("src", url).appendTo("body");
}
</script>
</body>
</html>