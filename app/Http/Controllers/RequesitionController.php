<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequesitionCreateRequest;
use App\Http\Requests\RequesitionItemAddProductRequest;
use App\Location;
use App\Project;
use App\Requesition;
use App\RequesitionItem;
use DB;
use Illuminate\Http\Request;

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
                'urlRedirect' => url("/requesitions/add-products/{$requesition->id}"),
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

        return view('requesitions.show', [
            'requesition' => $requesition,
            'items' => $requesition->items,
        ]);
    }

    public function addProducts($id)
    {
        $requesition = $this->requesition
            ->with([
                'items',
            ])
            ->where('id', $id)
            ->first();

        $locations = Location::orderBy('name', 'desc')
            ->lists('name', 'id');

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

        return redirect("/requesitions/add-products/{$id}");
    }

    public function statusPadding($id)
    {
        $requesition = $this->requesition
            ->with([
                'items',
            ])
            ->where('id', $id)
            ->first();

        $requesition->items()
            ->update(['status' => RequesitionItem::PADDING]);

        $requesition->status = Requesition::PADDING;
        $requesition->save();

        return [
            'status' => true,
            'title' => trans('requesition.label.name'),
            'message' => trans('requesition.message_alert.status_padding_message'),
            'url' => url("/requesitions/{$id}"),
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
        
        if($requesition == null){
            flash()->error(
                trans('requesition.label.name'),
                trans('requesition.message_alert.warning_is_not_padding')
            );

            return redirect('/requesitions');
        }

        return view('requesitions.processes', [ 
            'requesition'   => $requesition,
            'items'         => $requesition->items()->paginate(20),
        ]);
    }

    public function processSuccess(Request $request, $id)
    {
        $requesition = Requesition::with([
                'items' => function($query){
                    $query->where('status', RequesitionItem::PADDING);
                },
                'items.product',
                'items.product.stock',
            ])
            ->whereId($id)
            ->first();

        try{
            DB::transaction(function() use (&$requesition, $request) {

                $requesition->setStatusSuccess($request->get('requesition_item_ids'));
            });

            $url = url('/requesitions');

            if($requesition->status != Requesition::SUCCESS){
                $url = url("/requesitions/processes/{$requesition->id}");
            }

            return [
                'status' => true,
                'title' => trans('requesition.label.name'),
                'message' => trans('requesition.message_alert.status_success_message'),
                'url' => $url,
            ];
        } catch(Exception $e) {

            Log::error('requesition-item-unsuccess', array($e));

            return [
                'status' => false,
                'title' => trans('requesition.label.name'),
                'message' => trans('requesition.message_alert.status_success_unsuccess_message'),
                'url' => url("/requesitions/status-success/{$requesition->id}"),
            ];
        }
    }

    public function processCancel(Request $request, $id)
    {
        $requesition = Requesition::with([
                'items' => function($query){
                    $query->where('status', RequesitionItem::PADDING);
                },
                'items.product',
                'items.product.stock',
            ])
            ->whereId($id)
            ->first();

        try{
            DB::transaction(function() use (&$requesition, $request) {

                $requesition->setStatusCancel($request->get('requesition_item_ids'));
            });

            $url = url('/requesitions');

            if($requesition->status != Requesition::SUCCESS){
                $url = url("/requesitions/processes/{$requesition->id}");
            }

            return [
                'status' => true,
                'title' => trans('requesition.label.name'),
                'message' => trans('requesition.message_alert.status_cancel_message'),
                'url' => $url,
            ];
        } catch(Exception $e) {

            Log::error('requesition-item-unsuccess', array($e));

            return [
                'status' => false,
                'title' => trans('requesition.label.name'),
                'message' => trans('requesition.message_alert.status_cancel_unsuccess_message'),
                'url' => url("/requesitions/processes/{$requesition->id}"),
            ];
        }
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
