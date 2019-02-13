<thead>
  <tr>
    <th scope="col">ID</th>
    <th scope="col">@lang('messages.creator')</th>
    <th scope="col">@lang('messages.type')</th>
    <th scope="col">@lang('messages.amount')</th>
    <th scope="col">@lang('messages.create_date')</th>
    <th scope="col">@lang('messages.status')</th>
    <th scope="col">@lang('messages.action')</th>
  </tr>
</thead>
	
<tbody>
    @foreach ($userGroupRequests as $userGroupRequest)
	<tr>
		<td>{{ $userGroupRequest->id }}</td>
        <td>{{ $userGroupRequest->userGroup->users->name}}</td>
        <td>@if ($userGroupRequest->type == '0')
                @lang('messages.withdraw_money')
            @elseif ($userGroupRequest->type == '1')
                @lang('messages.raise_fund')
            @endif
        </td>
        <td>{{ number_format($userGroupRequest->value) }}</td>
        <td>{{ $userGroupRequest->created_at->format('d/m/Y  H:i') }}</td>
        <td>@if ($userGroupRequest->status == '0')
                <i class="glyphicon glyphicon-briefcase"></i><span class="font-weight-bold text-warning">Pending</span>
            @elseif ($userGroupRequest->status == '1')
                <i class="fa fa-check-circle"></i><span class="font-weight-bold text-danger">Accepted</span>
            @elseif ($userGroupRequest->status == '2')
                <i class="fa fa-skull-crossbones"></i><span class="font-weight-bold text-success">Declined</span>
            @endif
        </td>
        <td>@if($userGroupRequest->status == '0')
                {{ Form::model($userGroupRequest, array('route' => array('group_requests.update', $userGroupRequest->id))) }}
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    {{ Form::hidden('value', $userGroupRequest->value, array('class' => 'group-form')) }}
                    {{ Form::hidden('userGroupId', $userGroupRequest->user_group_id, array('class' => 'group-form')) }}
                    {{ Form::hidden('userGroupRequestId', $userGroupRequest->id, array('class' => 'group-form')) }}
                    {{ Form::hidden('type', $userGroupRequest->type) }}
                    {{ Form::submit(trans('Accept'), ['class' => 'btn btn-success']) }}
                {{ Form::close() }}
            @endif
        </td>
	</tr>
    @endforeach
</tbody>