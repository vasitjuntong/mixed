<div class="panel panel-default">
    <div class="panel-body">
        <table class="table table-striped">
            <thead>
            <tr>
                <th class="text-center" width="5%">
                    <label class="label-checkbox">
                        <input type="checkbox" id="chk_all">
                        <span class="custom-checkbox"></span>
                    </label>
                </th>
                <th width="10%">{{ trans('requesition_item.attributes.mix_no') }}</th>
                <th width="10%">{{ trans('requesition_item.attributes.product_code' )}}</th>
                <th width="10%">{{ trans('requesition_item.attributes.location_name') }}</th>
                <th>{{ trans('requesition_item.attributes.product_description') }}</th>
                <th width="10%">{{ trans('requesition_item.attributes.qty') }} (Remining)</th>
                <th width="20%">{{ trans('requesition_item.attributes.remark') }}</th>
                <th width="10%">{{ trans('requesition_item.attributes.status') }}</th>
            </tr>
            </thead>
            <tbody>
            @forelse($items as $item)
                <?php
                $productStock = $item->product
                        ->stock()
                        ->where('location_id', $item->location_id)
                        ->sum('qty');

                $classItem = ($item->qty <= $productStock) ? "success" : "danger";
                ?>
                <tr class="{{ $classItem }}">
                    <td class="text-center">
                        @if($item->status == \App\Requesition::PADDING)
                            <label class="label-checkbox">
                                <input type="checkbox"
                                       id="checkbox_products"
                                       name="products[]"
                                       value="{{ $item->id }}">
                                <span class="custom-checkbox"></span>
                            </label>
                        @endif
                    </td>
                    <td>{{ $item->mix_no }}</td>
                    <td>{{ $item->product_code }}</td>
                    <td>{{ $item->location_name }}</td>
                    <td>{!! $item->product_description !!}</td>
                    <td>{{ $item->qty }} ({{ $productStock }})</td>
                    <td>{{ $item->remark }}</td>
                    <td>{!! $item->statusHtml() !!}</td>
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

        <span class="text-center block">{!! $items->render() !!}</span>
    </div>
</div>