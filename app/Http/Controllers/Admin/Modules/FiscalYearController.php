<?php

// Controller namespacing.
namespace App\Http\Controllers\Admin\Modules;
use App\Http\Controllers\Controller;

// Facades.
use Yajra\Datatables\Datatables;
use Yajra\DataTables\Html\Builder;

// Models.
use App\Models\FiscalYear;

// Request
use App\Http\Requests\FiscalYearRequest;

// Traits
use App\Traits\DataTableActionsTrait;
use App\Traits\HasRightsTrait;

class FiscalYearController extends Controller
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
            return DataTables::of(FiscalYear::query())
            ->addColumn('action', function (FiscalYear $fiscal_year) {
                return
                    '<div class="d-flex">' .
                        $this->setAction('fiscalyear.index', $fiscal_year, 'view', 'fiscal-years', false) .
                        $this->setAction('fiscalyear.edit', $fiscal_year, 'update', 'fiscal-years') .
                        $this->setAction('fiscalyear.destroy', $fiscal_year, 'destroy', 'fiscal-years') .
                    '</div>';
            })
            ->make(true);
        }

        // Set values.
        $html = $builder
        ->addColumn([
                        'title' => __('Fiscal Year'),
                        'data' => 'year'
                    ])
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
        return view('admin.modules.fiscal-year.index', compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Init view.
        return view('admin.modules.fiscal-year.createEdit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FiscalYearRequest $request)
    {
        // Post data to database.
        FiscalYear::Create($request->validated());

        // Return back with message.
        return redirect()->route('fiscal-year.index')->with([
                'type' => 'success',
                'message' => __('Alert Add')
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FiscalYear  $fiscal_year
     * @return \Illuminate\Http\Response
     */
    public function edit(FiscalYear $fiscal_year)
    {
        // Init view.
        return view('admin.modules.fiscal-year.createEdit', compact('fiscal_year'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FiscalYear  $fiscal_year
     * @return \Illuminate\Http\Response
     */
    public function update(FiscalYearRequest $request, FiscalYear $fiscal_year)
    {
        // Set data to save into database.
        $fiscal_year->update($request->validated());

        // Save data.
        $fiscal_year->save();

        // Return back with message.
        return redirect()->route('fiscal-year.index')->with([
                'type' => 'success',
                'message' => __('Alert Edit')
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $fiscal_year
     * @return \Illuminate\Http\Response
     */
    public function destroy(FiscalYear $fiscal_year)
    {
        // Delete the model.
        $fiscal_year->delete();

        // Return back with message.
        return redirect()->back()->with([
            'type' => 'success',
            'message' => __('Alert Delete')
        ]);
    }
}
