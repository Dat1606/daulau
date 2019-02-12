<thead>
  <tr>
    <th scope="col">@lang('messages.month')</th>
    <th scope="col">@lang('messages.food')</th>
    <th scope="col">@lang('messages.general_product')</th>
    <th scope="col">@lang('messages.electricity_bill')</th>
    <th scope="col">@lang('messages.hire_fee')</th>
    <th scope="col">@lang('messages.water_bill')</th>
    <th scope="col">@lang('messages.others')</th>
    <th scope="col">@lang('messages.total_fee')</th>
  </tr>
</thead>

<tbody id="table-data">
    @foreach ($monData as $monData)
       	<tr>
        	<th scope="row">{{ substr($monData[0]->created_at, 5,2) }}</th>
        	<th>{{ number_format($monData->filter(function ($item) { return $item->type == 1;})->sum('total_fee'))}}</th>
        	<th>{{ number_format($monData->filter(function ($item) { return $item->type == 2;})->sum('total_fee'))}}</th>
        	<th>{{ number_format($monData->filter(function ($item) { return $item->type == 4;})->sum('total_fee'))}}</th>
        	<th>{{ number_format($monData->filter(function ($item) { return $item->type == 5;})->sum('total_fee'))}}</th>
        	<th>{{ number_format($monData->filter(function ($item) { return $item->type == 3;})->sum('total_fee'))}}</th>
        	<th>{{ number_format($monData->filter(function ($item) { return $item->type == 6;})->sum('total_fee'))}}</th>
        	<th>{{ number_format($monData->sum('total_fee')) }}</th>
     	</tr>
    @endforeach
</tbody>
