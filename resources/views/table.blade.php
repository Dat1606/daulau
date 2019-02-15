<thead>
  <tr>
    <th scope="col">@lang('messages.number')</th>
    <th scope="col">@lang('messages.product_name')</th>
    <th scope="col">@lang('messages.consumption_type')</th>
    <th scope="col">@lang('messages.quantity')</th>
    <th scope="col">@lang('messages.create_date')</th>
    <th scope="col">@lang('messages.buyer')</th>
    <th scope="col">@lang('messages.creator')</th>
    <th scope="col">@lang('messages.total_fee')</th>
    <th scope="col">@lang('messages.action')</th>
  </tr>
</thead>
<tbody id="table-data">
  @foreach ($groupConsumptions as $groupConsumption)
  <tr >
    <th scope="row">{{ $groupConsumption->id }}</th>
    <td>{{ $groupConsumption->name }}</td>
    <td>@lang('messages.'. (array_search($groupConsumption->type, config('group-consumption-type')) ?: 'others'))</td>
    <td>{{ $groupConsumption->quantity }}</td>
    <td>{{ $groupConsumption->created_at->format('d/m/Y  H:i') }}</td>
    <td>{{ $groupConsumption->user->name }}</td>
    <td>{{ $groupConsumption->creator->name }}</td>
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
  <script type="text/template" id="group-consumption-template">
    <tr>
      <th scope="row">%%group_consumption_id%%</th>
      <td>%%group_consumption_name%%</td>
      <td>%%group_consumption_type%%</td>
      <td>%%group_consumption_quantity%%</td>
      <td>%%group_consumption_created_at%%</td>
      <td>%%user_id%%</td>
      <td>%%creator_id%%</td>
      <td>%%group_consumption_total_fee%%</td>
      <td><a href="{{ route('group_consumptions.edit', '%%group_consumption_id%%') }}"><button class="btn btn-primary edit-btn"><i class="fa fa-edit"></i></button></a>
        <span class="delete-btn">
          {{ Form::open(['method' => 'DELETE', 'route' => array('group_consumptions.destroy', '%%group_consumption_id%%')]) }}
            {{ Form::hidden('id', '%%group_consumption_id%%') }}
            {{ Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-warning btn-sm'] )  }}
          {{ Form::close() }}
        </span>

      </td>
    </tr>
  </script> 
  <th scope="row">All Fees</th>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td id="total-fee">{{ number_format($all_consumptions) }} VND</td>
  {{ $groupConsumptions->links() }}
</tbody>
