<table class="table table-striped table-bordered table-hover" dir="rtl" style="text-align: right">
    <thead>
        <th> {{__('contract::dashboard.contracts.show.details.type') }} </th>
        <th> {{__('contract::dashboard.contracts.show.info.client.name') }} </th>
        <th> {{__('contract::dashboard.contracts.show.details.description') }} </th>
        <th> {{__('contract::dashboard.contracts.show.details.notes') }} </th>
        @if(!$hide_price)
        <th> {{__('contract::dashboard.contracts.show.details.price') }} </th>
        @endif
        <th> {{__('contract::dashboard.contracts.show.details.final_price') }} </th>
    </thead>
    <tbody>
        @forelse ($model->lines as $line)
            <tr>
                <td>{{$line->type->title}}</td>
                <td>{{$line->name}}</td>
                <td>{{$line->description}}</td>
                <td>{{$line->notes}}</td>
                @if(!$hide_price)
                <td>{{$line->price}}</td>
                @endif
                <td>{{$line->price_with_fees == 0 ?
                ( number_format( $line->price + ( ($line->price * $line->contract->installment_fees) / 100 ) ,0 ,2) )
                : $line->price_with_fees}}</td>
            </tr>
        @empty

        @endforelse
        <tr>
            <td colspan="@if(!$hide_price) 5 @else 4 @endif">
                المجموع
            </td>
            <td>
                {{abs($model->lines->sum('price_with_fees'))}}
            </td>
        </tr>
    </tbody>
</table>
