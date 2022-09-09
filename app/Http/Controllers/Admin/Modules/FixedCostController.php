<?php

// Controller namespacing.
namespace App\Http\Controllers\Admin\Modules;
use App\Http\Controllers\Controller;

// Facades.
use Yajra\Datatables\Datatables;
use Yajra\DataTables\Html\Builder;

// Models.
use App\Models\AdministratorFixedCost;
use App\Models\FiscalYear;
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
            return DataTables::of(FixedCost::query()->with(['bankaccount', 'category', 'company'])->select('fixed_costs.*'))
            ->editColumn('cost', function(FixedCost $fixed_cost) {
                return '€ ' . number_format($fixed_cost->cost, 2, ',', '.');
            })
            ->addColumn('action', function (FixedCost $fixed_cost) {
                return
                    '<div class="d-flex">' .
                        $this->setAction('fixedcost.index', $fixed_cost, 'view', 'fixed-costs', false) .
                        $this->setAction('fixedcost.edit', $fixed_cost, 'update', 'fixed-costs') .
                        $this->setAction('fixedcost.destroy', $fixed_cost, 'destroy', 'fixed-costs') .
                    '</div>';
            })
            ->make(true);
        }

        // Set values.
        $html = $builder
                    ->addColumn([
                        'title' => __('Bankaccount'),
                        'data' => 'bankaccount.name'
                    ])
                    ->addColumn([
                        'title' => 'Rekeningnummer',
                        'data' => 'bankaccount.accountnumber'
                    ])
                    ->addColumn([
                        'title' => __('Category'),
                        'data' => 'category.name'
                    ])
                    ->addColumn([
                        'title' => __('Company'),
                        'data' => 'company.name'
                    ])
                    ->addColumn([
                        'title' => 'Kosten',
                        'data' => 'cost'
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
        $fixed_cost = FixedCost::Create([
            'fiscal_year_id' => $this->getFiscalYear(session()->get('fiscal_year'))['id'],
            'is_shared' => ($request->is_shared == 1 ? $request->is_shared : 0)
        ] + $request->validated());

        // Insert into pivot.
        $this->setAdministratorFixedCost($request, $fixed_cost);

        // Return back with message.
        return redirect()->route('fixed-cost.index')->with([
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
        $fixed_cost->update([
            'fiscal_year_id' => $this->getFiscalYear(session()->get('fiscal_year'))['id'],
            'is_shared' => ($request->is_shared == 1 ? $request->is_shared : 0)
        ] + $request->validated());

        // Save data.
        $fixed_cost->save();

        // Delete the pivot and add the new ones.
        AdministratorFixedCost::where('fixed_cost_id', $fixed_cost->id)->delete();
        $this->setAdministratorFixedCost($request, $fixed_cost);

        // Return back with message.
        return redirect()->route('fixed-cost.index')->with([
                'type' => 'success',
                'message' => __('Alert Edit')
            ]
        );
    }

    /**
     * Update the pivot table.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FixedCost  $fixedCost
     * @return \Illuminate\Http\Response
     */
    private function setAdministratorFixedCost($request, $fixedCost)
    {
        // Delete and reset the pivot table.
        if((int) $request->is_shared == 1)
        {
            $administratorFixedCosts = [
                [
                    'admin_id' => 1,
                    'fixed_cost_id' => $fixedCost->id
                ],
                [
                    'admin_id' => 2,
                    'fixed_cost_id' => $fixedCost->id
                ]
            ];

            foreach($administratorFixedCosts as $administratorFixedCost)
                AdministratorFixedCost::create($administratorFixedCost);
        }
        else
        {
            AdministratorFixedCost::create(
            [
                'admin_id' => auth()->user()->id,
                'fixed_cost_id' => $fixedCost->id
            ]);
        }
    }

    /**
     * Get the fiscal year.
     *
     * @param  \App\Models\FixedCost  $fixedCost
     * @return \Illuminate\Http\Response
     */
    private function getFiscalYear($fixedCost)
    {
        return FiscalYear::where('year', $fixedCost)->first();
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
