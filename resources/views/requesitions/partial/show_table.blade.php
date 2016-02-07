<table class="table table-striped">
    <thead>
    <tr>
        <th width="10%">{{ trans('requesition_item.attributes.mix_no') }}</th>
        <th width="10%">{{ trans('requesition_item.attributes.product_code' )}}</th>
        <th width="10%">{{ trans('requesition_item.attributes.location_name') }}</th>
        <th>{{ trans('requesition_item.attributes.product_description') }}</th>
        <th width="10%">{{ trans('requesition_item.attributes.unit') }}</th>
        <th width="10%">{{ trans('requesition_item.attributes.qty') }} <span class="hidden-print">(Remining)</span></th>
        <th width="10%">{{ trans('requesition_item.attributes.remark') }}</th>
        <th class="hidden-print" width="10%">Proccess</th>
    </tr>
    </thead>
    <tbody>
    @forelse($items as $item)
        <?php
        $productStock = $item->product
                ->stock()
                ->where('location_id', $item->location_id)
                ->sum('qty');
        ?>
        <tr>
            <td>{{ $item->mix_no }}</td>
            <td>
                {{ $item->product_code }}
            </td>
            <td>{{ $item->location_name }}</td>
            <td>{!! $item->product_description !!}</td>
            <td>{{ $item->product->unit->name }}</td>
            <td>
                @if($item->requesition->status != \App\RequesitionItem::SUCCESS)
                    <a href="#"
                       id="editable-qty"
                       data-qty="integer"
                       data-method="get"
                       data-pk="{{ $item->id }}"
                       data-url="/requisition-update-qty/{{ $item->id }}/{{ $item->product_id }}/{{ $item->location_id }}"
                       data-title="Enter QTY">
                        {{ $item->qty }}
                    </a> <span class="hidden-print">({{ $productStock }})</span>
                @else
                    {{ $item->qty }} <span class="hidden-print">({{ $productStock }})</span>
                @endif
            </td>
            <td>{{ $item->remark }}</td>
            <td class="hidden-print">{!! $item->statusHtml() !!}</td>
        </tr>
    @empty
        <tr>
            <td class="text-center text-danger" colspan="8">
                {{ trans('requesition_item.label.empty_data') }}
            </td>
        </tr>
    @endforelse
    </tbody>
</table>