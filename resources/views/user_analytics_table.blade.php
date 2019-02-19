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
    @forelse ($users as $user)
        <tr>
        	<td>{{ $user->name }}</td>
            <td>{{ number_format($user->userGroups[0]->supported_budget) }}</td>
            <td>{{ number_format($user->groupConsumptions->pluck('total_fee')->sum()) }}</td>
            <td>{{ number_format($user->userGroups[0]->withdrew_money) }}</td>
            <td>{{ number_format(-((($users->pluck('groupConsumptions')->flatten()->pluck('total_fee')->sum() + $groupFund->pluck('supported_budget')->sum() - $groupFund->pluck('withdrew_money')->sum())/$users->count()) - ($user->userGroups[0]->supported_budget + $user->groupConsumptions->pluck('total_fee')->sum() - $user->userGroups[0]->withdrew_money))) }}</td>
        </tr>

    @empty
        <tr>s</tr>
    @endforelse
</tbody>