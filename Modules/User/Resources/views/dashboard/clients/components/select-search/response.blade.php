
<div>
    <div>
        <h5>{{$model->name}}</h5>
    </div>
    <div class='select2-result-repository__forks'>
        {{$model->national_ID}}</div>
    <br>
    <div class='select2-result-repository__forks'>
        {{$model->email}}</div>
    <br>
    <div class='select2-result-repository__forks'>
        {{optional($model->phone)->phone}}
    </div>
</div>