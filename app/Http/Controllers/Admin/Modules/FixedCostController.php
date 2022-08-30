<?php

// Controller namespacing.
namespace App\Http\Controllers\Admin\Modules;
use App\Http\Controllers\Controller;

// Facades.
use Yajra\Datatables\Datatables;
use Yajra\DataTables\Html\Builder;

// Models.
use App\Models\FixedCost;

// Request
use App\Http\Requests\FixedCostRequest;

// Traits
use App\Traits\DataTableActionsTrait;
use App\Traits\HasRightsTrait;

class FixedCostController extends Controller
{
    /**
     * Traits
     *
     */
    use DataTableActionsTrait,
        HasRightsTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Builder $builder)
    {
        // Init datatables.
        if (request()->ajax()) {
            return DataTables::of(FixedCost::query())
            ->addColumn('action', function (FixedCost $fixed_cost) {
                return
                    '<div class="d-flex">' .
                        $this->setAction('fixedcost.index', $fixed_cost, 'view', 'fixed_costs', false) .
                        $this->setAction('fixedcost.edit', $fixed_cost, 'update', 'fixed_costs') .
                        $this->setAction('fixedcost.destroy', $fixed_cost, 'destroy', 'fixed_costs') .
                    '</div>';
            })
            ->make(true);
        }

        // Set values.
        $html = $builder
                    ->addColumn([
                        'title' => __('Name'),
                        'data' => 'name'
                    ])
                    ->addAction([
                        'title' => __('Actions'),
                        'class' => 'actionHandler'
                    ])
                    ->parameters([
                        'order' =>
                            [0,'asc']
                    ]);

        // Init view.
        return view('admin.modules.fixed-cost.index', compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Init view.
        return view('admin.modules.fixed-cost.createEdit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FixedCostRequest $request)
    {
        // Post data to database.
        FixedCost::Create($request->validated());

        // Return back with message.
        return redirect()->route('fixedcost.index')->with([
                'type' => 'success',
                'message' => __('Alert Add')
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FixedCost  $fixed_cost
     * @return \Illuminate\Http\Response
     */
    public function edit(FixedCost $fixed_cost)
    {
        // Init view.
        return view('admin.modules.fixed-cost.createEdit', compact('fixed_cost'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FixedCost  $fixed_cost
     * @return \Illuminate\Http\Response
     */
    public function update(FixedCostRequest $request, FixedCost $fixed_cost)
    {
        // Set data to save into database.
        $fixed_cost->update($request->validated());

        // Save data.
        $fixed_cost->save();

        // Return back with message.
        return redirect()->route('fixedcost.index')->with([
                'type' => 'success',
                'message' => __('Alert Edit')
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $fixed_cost
     * @return \Illuminate\Http\Response
     */
    public function destroy(FixedCost $fixed_cost)
    {
        // Delete the model.
        $fixed_cost->delete();

        // Return back with message.
        return redirect()->back()->with([
            'type' => 'success',
            'message' => __('Alert Delete')
        ]);
    }
}
