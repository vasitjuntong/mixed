<?php

namespace App\Http\Controllers;

use App\Notify;

class NotifyController extends Controller
{
    protected $model;

    public function __construct(Notify $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        $notifies = $this->model
            ->where('read', 0)
            ->latest()
            ->paginate(20);

        return view('notifies.all', [
            'notifies' => $notifies,
        ]);
    }
}
