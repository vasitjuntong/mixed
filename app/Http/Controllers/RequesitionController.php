<?php

namespace App\Http\Controllers;

use DB;
use Log;
use Exception;
use Response;
use App\Stock;
use Validator;
use App\Project;
use App\Location;
use App\Requesition;
use App\RequesitionItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Excel\ExportExcelRequisition;
use App\Http\Requests\RequesitionCreateRequest;
use App\Http\Requests\RequesitionItemAddProductRequest;

class RequesitionController extends Controller
{
    protected $item;
    protected $requesition;

    public function __construct(Requesition $requesition, RequesitionItem $item)
    {
        $this->item = $item;
        $this->requesition = $requesition;
    }

    public function index(Request $request)
    {
        $requesitions = $this->requesition
            ->orderBy('created_at', 'desc')
            ->get();

        return view('requesitions.index', [
            'requesitions' => $requesitions,
        ]);
    }

    public function create()
    {
        $projects = Project::lists('code', 'id');

        return view('requesitions.create_modal', [
            'projects' => $projects,
        ]);
    }

    public function store(RequesitionCreateRequest $request)
    {
        $data = $request->all();

        $project_id = $request->get('project_id');

        $data['project_code'] = Project::find($project_id)->code;
        $data['user_id'] = $request->user()->id;

        $requesition = '';

        DB::transaction(function () use (&$requesition, $data) {
            $requesition = Requesition::create($data);

        });

        if ($requesition) {

            return [
                'status' => 'success',
                'urlRedirect' => url("/requisitions/add-products/{$requesition->id}"),
            ];
        }
    }

    public function show($id)
    {
        $requesition = $this->requesition
            ->with([
                'items',
                'project',
                'items.product',
                'items.product.unit',
            ])
            ->where('id', $id)
            ->first();

        $projectLists = Project::lists('code', 'id');

        return view('requesitions.show', [
            'requesition' => $requesition,
            'items' => $requesition->items,
            'projectLists' => $projectLists,
        ]);
    }

    public function addProducts($id)
    {
        $requesition = $this->requesition
            ->with([
                'items',
            ])
            ->where('id', $id)
            ->whereStatus(RequesitionItem::CREATE)
            ->firstOrFail();

        $locations = Location::lists('name', 'id');

        $locationLists = [null => trans('main.label.select')];
        if ($locations != null) {
            $locationLists = $locationLists + $locations->toArray();
        }

        return view('requesitions.add_product', [
            'requesition' => $requesition,
            'items' => $requesition->items,
            'locationLists' => $locationLists,
        ]);
    }

    public function storeProduct(RequesitionItemAddProductRequest $request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            $this->item->add($id, $request->all());
        });

        return Response::json(['status' => 'success'], 200);
    }

    public function statusPadding($id)
    {
        $requesition = $this->requesition
            ->with([
                'items',
            ])
            ->where('id', $id)
            ->whereStatus(Requesition::CREATE)
            ->firstOrFail();

        foreach ($requesition->items as $item) {
            $item->status = RequesitionItem::PADDING;

            $item->save();
        }

        $requesition->status = Requesition::PADDING;
        $requesition->save();

        return [
            'status' => true,
            'title' => trans('requesition.label.name'),
            'message' => trans('requesition.message_alert.status_padding_message'),
            'url' => url("/requisitions/{$id}"),
        ];
    }

    public function process($id)
    {
        $requesition = $this->requesition
            ->with([
                'items',
            ])
            ->where('status', Requesition::PADDING)
            ->where('id', $id)
            ->first();

        if ($requesition == null) {
            flash()->error(
                trans('requesition.label.name'),
                trans('requesition.message_alert.warning_is_not_padding')
            );

            return redirect('/requisitions');
        }

        return view('requesitions.processes', [
            'requesition' => $requesition,
            'items' => $requesition->items()->paginate(20),
        ]);
    }

    public function processSuccess(Request $request, $id)
    {
        $requesition = Requesition::with([
            'items' => function ($query) {
                $query->where('status', RequesitionItem::PADDING);
            },
            'items.product',
            'items.product.stock',
        ])
            ->whereId($id)
            ->first();

        try {
            $url = url('/requisitions');

            DB::transaction(function () use (&$requesition, $request, &$url) {
                $requesition->setStatusSuccess($request->get('requesition_item_ids'));

                if ($requesition->status != Requesition::SUCCESS) {
                    $url = url("/requisitions/processes/{$requesition->id}");
                }

                if ($requesition->status == Requesition::SUCCESS) {
                    app('App\Stock')->cutStock($requesition);
                }
            });

            return [
                'status' => true,
                'title' => trans('requesition.label.name'),
                'message' => trans('requesition.message_alert.status_success_message'),
                'url' => $url,
            ];
        } catch (Exception $e) {
            Log::error('requesition-item-unsuccess', [
                $e
            ]);

            return [
                'status' => false,
                'title' => trans('requesition.label.name'),
                'message' => $e->getMessage(),
                'url' => url("/requisitions/status-success/{$requesition->id}"),
            ];
        }
    }

    public function processCancel(Request $request, $id)
    {
        $requesition = Requesition::with([
            'items' => function ($query) {
                $query->where('status', RequesitionItem::PADDING);
            },
            'items.product',
            'items.product.stock',
        ])
            ->whereId($id)
            ->first();

        try {
            DB::transaction(function () use (&$requesition, $request) {

                $requesition->setStatusCancel($request->get('requesition_item_ids'));
            });

            $url = url('/requisitions');

            if ($requesition->status != Requesition::SUCCESS) {
                $url = url("/requisitions/processes/{$requesition->id}");
            }

            return [
                'status' => true,
                'title' => trans('requesition.label.name'),
                'message' => trans('requesition.message_alert.status_cancel_message'),
                'url' => $url,
            ];
        } catch (Exception $e) {

            Log::error('requesition-item-unsuccess', [$e]);

            return [
                'status' => false,
                'title' => trans('requesition.label.name'),
                'message' => trans('requesition.message_alert.status_cancel_unsuccess_message'),
                'url' => url("/requisitions/processes/{$requesition->id}"),
            ];
        }
    }

    public function editMulti()
    {
        $rules = [
            'project_id' => [
                'project_id' => 'required',
            ],
            'site_id' => [
                'site_id' => 'required|max:255',
            ],
            'site_name' => [
                'site_name' => 'required|max:255',
            ],
            'receive_company_name' => [
                'receive_company_name' => 'required|max:255',
            ],
            'receive_contact_name' => [
                'receive_contact_name' => 'required|max:255',
            ],
            'receive_phone' => [
                'receive_phone' => 'required|max:255',
            ],
            'receive_date' => [
                'receive_date' => 'required|date_format:Y-m-d',
            ],
        ];

        $pk = request()->get('pk');
        $value = request()->get('value');
        $attribute = request()->get('name');

        $data = [
            $attribute => $value,
        ];

        $validator = Validator::make($data, $rules[$attribute]);

        if ($validator->passes()) {
            $requisition = Requesition::find($pk);

            if ($attribute == 'project_id') {
                $requisition->$attribute = $value;
                $requisition->project_code = Project::find($value)->code;
            } else {
                $requisition->$attribute = $value;
            }

            $requisition->save();

            return Response::json('success', 200);
        }

        return Response::json($validator->errors()->first($attribute), 422);
    }

    public function updateQty($id, $productId, $locationId)
    {
        $qty = request()->get('value');

        $data = [
            'qty' => $qty,
        ];

        $rules = [
            'qty' => 'required|integer',
        ];

        $validator = Validator::make($data, $rules);

        if (!$validator->passes()) {
            return Response::json($validator->errors()->first('qty'), 422);
        }

        $stock = Stock::join('products', 'stocks.product_id', '=', 'products.id')
            ->join('locations', 'stocks.location_id', '=', 'locations.id')
            ->where('product_id', $productId)
            ->where('location_id', $locationId)
            ->first([
                'products.description as product_description',
                'stocks.qty as qty',
                'locations.name as location_name'
            ]);

        if ($stock->qty < $qty) {
            return Response::json("Product {$stock->product_description} on location {$stock->location_name} remining is {$stock->qty}.",
                422, [], JSON_UNESCAPED_UNICODE);
        }

        $item = RequesitionItem::find($id);
        $item->qty = $qty;

        $item->save();

        return Response::json('success', 200);
    }

    public function downloadExcel(ExportExcelRequisition $excel, $id)
    {
        $model = Requesition::getOnce($id);

        foreach ($model->items as $item) {
            $excel->add([
                'group' => $item->group,
                'number' => $item->number,
                'product' => $item->product_code,
                'qty' => $item->qty,
                'unit' => $item->product->unit->name,
            ]);
        }

        $excel->download();
    }
}
