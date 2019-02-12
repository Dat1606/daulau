<thead>
  <tr>
    <th scope="col">@lang('messages.number')</th>
    <th scope="col">@lang('messages.product_name')</th>
    <th scope="col">@lang('messages.consumption_type')</th>
    <th scope="col">@lang('messages.quantity')</th>
    <th scope="col">@lang('messages.create_date')</th>
    <th scope="col">@lang('messages.creator')</th>
    <th scope="col">@lang('messages.total_fee')</th>
  </tr>
</thead>
<tbody id="table-data">
  @foreach ($groupConsumptions as $groupConsumption)
  <tr >
    <th scope="row">{{ $groupConsumption->id }}</th>
    <td>{{ $groupConsumption->name }}</td>
    <td> @if ($groupConsumption->type == 1)
            @lang('messages.food')
          @elseif ($groupConsumption->type == 2)
            @lang('messages.general_product')
          @elseif ($groupConsumption->type == 3)
            @lang('messages.water_bill')
          @elseif ($groupConsumption->type == 4)
            @lang('messages.electricity_bill')
          @elseif ($groupConsumption->type == 5)
            @lang('messages.hire_fee')
          @else
            @lang('messages.others')
          @endif
    </td>
    <td>{{ $groupConsumption->quantity }}</td>
    <td>{{ $groupConsumption->created_at }}</td>
    <td>{{ DB::table('users')->where('id', $groupConsumption->user_id)->value('name') }}</td>
    <td>{{ number_format( $groupConsumption->total_fee) }}</td>
  </tr>
  @endforeach
  <th scope="row">All Fees</th>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td id="total-fee">{{ number_format($all_consumptions[0]['sum(total_fee)']) }} VND</td>
  {{ $groupConsumptions->links() }}
</tbody>