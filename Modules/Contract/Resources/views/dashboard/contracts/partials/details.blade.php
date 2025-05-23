    <tr>
        <td>
            <div class="form-group">
                <select name="details[contract_line_type_id][]" id="" class="form-control" style="max-width: 150px; margin: 0 auto">
                    @forelse (\Modules\Contract\Entities\ContractLineTypes::cursor() as $type)
                        <option value="{{$type->id}}"
                            @isset($line) @if($line->contract_line_type_id==$type->id) selected @endif @endisset
                            >{{$type->title}}</option>
                    @empty

                    @endforelse
                </select>
            </div>
        </td>
        <td>
            <div class="form-group">
                <input type="text" name="details[name][]" @if($fill)value="{{$line->name??''}}"@endif class="form-control" style="max-width: 200px; margin: 0 auto">
            </div>
        </td>
        <td>
            <div class="form-group">
                <input type="text" name="details[description][]" @if($fill)value="{{$line->description??''}}"@endif class="form-control" style="max-width: 200px; margin: 0 auto">
            </div>
        </td>
        <td>
            <div class="form-group">
                <input type="text" name="details[notes][]" @if($fill)value="{{$line->notes??''}}"@endif class="form-control" style="max-width: 200px; margin: 0 auto">
            </div>
        </td>
        <td>
            <div class="form-group">
                <input type="number" step="0.01" name="details[price][]" @if($fill)value="{{$line->price??''}}"@endif class="form-control" style="max-width: 90px; margin: 0 auto">
            </div>
        </td>
        <td>
            <div class="form-group">
                @if(!$fill)
                <div>
                    <button class="btn btn-sm btn-primary add_details" type="button"><i class="fa fa-plus"></i></button>
                    <button class="btn btn-sm btn-danger remove_details" type="button"><i class="fa fa-minus"></i></button>
                </div>
                @endif
            </div>
        </td>
    </tr>
