<thead>
  <tr>
    <th scope="col">@lang('messages.name')</th>
    <th scope="col">@lang('messages.supported_budget')</th>
    <th scope="col">@lang('messages.consumption')</th>
    <th scope="col">@lang('messages.withdrew_money')</th>
    <th scope="col">@lang('messages.remaining_budget')</th>
  </tr>
</thead>
	
<tbody>
    @foreach ($users as $user)
        <tr>
        	<td>{{ $user->first()->name }}</td>
            <td>{{ number_format($user->first()->supported_budget) }}</td>
            <td>{{ number_format($user->pluck('total_fee')->sum()) }}</td>
            <td>{{ number_format($user->first()->withdrew_money) }}</td>
            <td>{{ number_format(-((($rawUsers->pluck('total_fee')->sum() + $groupFund->pluck('supported_budget')->sum() - $groupFund->pluck('withdrew_money')->sum())/$users->count()) - ($user->first()->supported_budget + $user->pluck('total_fee')->sum() - $user->first()->withdrew_money))) }}</td>
        </tr>
    @endforeach
</tbody>