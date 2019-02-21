<thead>
  <tr>
    <th scope="col">@lang('messages.number')</th>
    <th scope="col">@lang('messages.product_name')</th>
    <th scope="col">@lang('messages.consumption_type')</th>
    <th scope="col">@lang('messages.quantity')</th>
    <th scope="col">@lang('messages.create_date')</th>
    <th scope="col">@lang('messages.total_fee')</th>
    <th scope="col">@lang('messages.action')</th>
  </tr>
</thead>
<tbody id="table-data">
  @foreach ($userGroup->group->groupConsumptions->where('user_id', $user->id) as $groupConsumption)
  <tr >
    <th scope="row">{{ $groupConsumption->id }}</th>
    <td>{{ str_limit($groupConsumption->name, $limit=12, $end='...') }}</td>
    <td>{{ str_limit(trans('messages.'. (array_search($groupConsumption->type, config('group-consumption-type')) ?: 'others')), $limit=7, $end='...' ) }}</td>
    <td>{{ $groupConsumption->quantity }}</td>
    <td>{{ $groupConsumption->created_at->format('d/m/Y  H:i') }}</td>
    <td>{{ number_format( $groupConsumption->total_fee) }}</td>
    <td><a href="{{ route('group_consumptions.edit',$groupConsumption->id) }}"><button class="btn btn-primary edit-btn"><i class="fa fa-edit"></i></button></a>
      <span class="delete-btn">
        {{ Form::open(['method' => 'DELETE', 'route' => array('group_consumptions.destroy', $groupConsumption->id)]) }}
          {{ Form::hidden('id', $groupConsumption->id) }}
          {{ Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-warning btn-sm'] )  }}
        {{ Form::close() }}
      </span>
    </td>
  </tr>
  @endforeach
  <div id="last-record">
    <th scope="row">All Fees</th>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td id="total-fee">{{ number_format($userGroup->group->groupConsumptions->where('user_id', $user->id)->sum('total_fee')) }} VND</td>
{{--     {{ $group->group->groupConsumptions->links() }}  --}}
  </div>
</tbody>