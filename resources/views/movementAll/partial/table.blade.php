<table class="table table-striped" id="dataTable">
    <thead>
    <tr>
        <th width="10%">
            {!! link_to_sortable(trans('movement_all.attributes.created_at'), 'created_at') !!}
        </th>
        <th width="10%">
            {!! link_to_sortable(trans('movement_all.attributes.type'), 'type') !!}
        </th>
        <th width="10%">
            {!! link_to_sortable(trans('movement_all.attributes.dn'), 'dn') !!}
        </th>
        <th width="10%">
            {!! link_to_sortable(trans('movement_all.attributes.project'), 'project') !!}
        </th>
        <th width="10%">
            {!! link_to_sortable(trans('movement_all.attributes.product_mix_no'), 'product_mix_no') !!}
        </th>
        <th width="8%">
            {!! link_to_sortable(trans('movement_all.attributes.product_description'), 'product_description') !!}
        </th>
        <th width="12%">
            {!! link_to_sortable(trans('movement_all.attributes.product_qty'), 'product_qty') !!}
        </th>
        <th width="5%">
            {!! link_to_sortable(trans('movement_all.attributes.product_unit'), 'product_unit') !!}
        </th>
        <th width="5%">
            {!! link_to_sortable(trans('movement_all.attributes.product_remark'), 'product_remark') !!}
        </th>
        <th width="10%">
            {!! link_to_sortable(trans('movement_all.attributes.location_or_site_name'), 'location_or_site_name') !!}
        </th>
        <th width="5%">
            {!! link_to_sortable(trans('movement_all.attributes.status'), 'status') !!}
        </th>
    </tr>
    </thead>
    <tbody>
    @if($model->count())
        @foreach($model as $item)
            <tr>
                <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                <td>{{ $item->type }}</td>
                <td>
                    {{ $item->dn }}
                </td>
                <td>{{ $item->project }}</td>
                <td>{{ $item->product_mix_no }}</td>
                <td>{{ $item->product_description }}</td>
                <td>{{ $item->product_qty }}</td>
                <td>{{ $item->product_unit }}</td>
                <td>{{ $item->product_remark }}</td>
                <td>{{ $item->location_or_site_name }}</td>
                <td>{!! $item->statusHtml() !!}</td>
            </tr>
        @endforeach
    @else
        <tr>
            <td class="text-center text-danger" colspan="11">{{ trans('receive_item.label.empty_data') }}</td>
        </tr>
    @endif
    </tbody>
</table>
<span class="text-center block">{!! $model->appends($filter)->render() !!}</span>
