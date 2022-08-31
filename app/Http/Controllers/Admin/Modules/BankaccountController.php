<?php

// Controller namespacing.
namespace App\Http\Controllers\Admin\Modules;
use App\Http\Controllers\Controller;

// Facades.
use Yajra\Datatables\Datatables;
use Yajra\DataTables\Html\Builder;

// Models.
use App\Models\Bankaccount;
use App\Models\AdministratorBankaccount;

// Request
use App\Http\Requests\BankaccountRequest;

// Traits
use App\Traits\DataTableActionsTrait;
use App\Traits\HasRightsTrait;

class BankaccountController extends Controller
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
            return DataTables::of(Bankaccount::query()->with(['bankaccount_types']))
            ->editColumn('balance', function(Bankaccount $bankaccount) {
                return '€ ' . number_format($bankaccount->balance, 2, ',', '.');
            })
            ->editColumn('is_shared', function(Bankaccount $bankaccount) {
                if($bankaccount->is_shared === 1)
                    return '<span class="badge bg-success d-block"><i class="fas fa-check"></i></span>';
                else
                    return '<span class="badge bg-danger d-block"><i class="fas fa-times"></i></span>';
            })
            ->addColumn('action', function (Bankaccount $bankaccount) {
                return
                    '<div class="d-flex">' .
                        $this->setAction('bankaccount.index', $bankaccount, 'view', 'bankaccounts', false) .
                        $this->setAction('bankaccount.edit', $bankaccount, 'update', 'bankaccounts') .
                        $this->setAction('bankaccount.destroy', $bankaccount, 'destroy', 'bankaccounts') .
                    '</div>';
            })
            ->rawColumns([
                'is_shared',
                'action'
            ])
            ->make(true);
        }

        // Set values.
        $html = $builder
                    ->addColumn([
                        'title' => __('Bankaccount'),
                        'data' => 'accountnumber'
                    ])
                    ->addColumn([
                        'title' => __('Name'),
                        'data' => 'name'
                    ])
                    ->addColumn([
                        'title' => __('Bankaccount Type'),
                        'data' => 'bankaccount_types.name'
                    ])
                    ->addColumn([
                        'title' => __('Balance'),
                        'data' => 'balance'
                    ])
                    ->addColumn([
                        'title' => 'Gedeelde rekening',
                        'data' => 'is_shared',
                        'width' => 40
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
        return view('admin.modules.bankaccount.index', compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Init view.
        return view('admin.modules.bankaccount.createEdit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BankaccountRequest $request)
    {
        // Post data to database.
        $bankaccount = Bankaccount::Create([
            'is_shared' => ($request->is_shared == 1 ? $request->is_shared : 0)
        ] + $request->validated());

        // Insert into pivot.
        $this->setAdminBankAccounts($request, $bankaccount);

        // Return back with message.
        return redirect()->route('bankaccount.index')->with([
                'type' => 'success',
                'message' => __('Alert Add')
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bankaccount  $bankaccount
     * @return \Illuminate\Http\Response
     */
    public function edit(Bankaccount $bankaccount)
    {
        // Init view.
        return view('admin.modules.bankaccount.createEdit', compact('bankaccount'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bankaccount  $bankaccount
     * @return \Illuminate\Http\Response
     */
    public function update(BankaccountRequest $request, Bankaccount $bankaccount)
    {
        // Set data to save into database.
        $bankaccount->update([
            'is_shared' => ($request->is_shared == 1 ? $request->is_shared : 0)
        ] + $request->validated());

        // Save data.
        $bankaccount->save();

        // Delete the pivot and add the new ones.
        AdministratorBankaccount::where('bankaccount_id', $bankaccount->id)->delete();
        $this->setAdminBankAccounts($request, $bankaccount);

        // Return back with message.
        return redirect()->route('bankaccount.index')->with([
                'type' => 'success',
                'message' => __('Alert Edit')
            ]
        );
    }

    private function setAdminBankAccounts($request, $bankaccount)
    {
        // Delete and reset the pivot table.
        if((int) $request->is_shared == 1)
        {
            $administratorBankaccounts = [
                [
                    'admin_id' => 1,
                    'bankaccount_id' => $bankaccount->id
                ],
                [
                    'admin_id' => 2,
                    'bankaccount_id' => $bankaccount->id
                ]
            ];

            foreach($administratorBankaccounts as $administratorBankaccount)
                AdministratorBankaccount::create($administratorBankaccount);
        }
        else
        {
            AdministratorBankaccount::create(
            [
                'admin_id' => auth()->user()->id,
                'bankaccount_id' => $bankaccount->id
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $bankaccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bankaccount $bankaccount)
    {
        // Delete the model.
        $bankaccount->delete();

        // Return back with message.
        return redirect()->back()->with([
            'type' => 'success',
            'message' => __('Alert Delete')
        ]);
    }
}
