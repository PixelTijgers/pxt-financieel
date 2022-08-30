<?php

// Controller namespacing.
namespace App\Http\Controllers\Admin\Modules;
use App\Http\Controllers\Controller;

// Facades.
use Yajra\Datatables\Datatables;
use Yajra\DataTables\Html\Builder;

// Models.
use App\Models\AdministratorPayment;
use App\Models\FiscalYear;
use App\Models\Payment;

// Request
use App\Http\Requests\PaymentRequest;

// Traits
use App\Traits\DataTableActionsTrait;
use App\Traits\HasRightsTrait;

class PaymentController extends Controller
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
            return DataTables::of(Payment::query()->with(['payment_type','category','company']))
            ->editColumn('balance', function(Payment $payment) {
                return '€ ' . number_format($payment->balance, 2, ',', '.');
            })
            ->addColumn('action', function (Payment $payment) {
                return
                    '<div class="d-flex">' .
                        $this->setAction('payment.index', $payment, 'view', 'payments', false) .
                        $this->setAction('payment.edit', $payment, 'update', 'payments') .
                        $this->setAction('payment.destroy', $payment, 'destroy', 'payments') .
                    '</div>';
            })
            ->make(true);
        }

        // Set values.
        $html = $builder
                    ->addColumn([
                        'title' => __('Payment Cost'),
                        'data' => 'balance'
                    ])
                    ->addColumn([
                        'title' => __('Payment Reference'),
                        'data' => 'payment_reference'
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
                        'title' => __('Payment Type'),
                        'data' => 'payment_type.name'
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
        return view('admin.modules.payment.index', compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Init view.
        return view('admin.modules.payment.createEdit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentRequest $request)
    {
        // Get the selected season.
        $getFiscalYear = FiscalYear::where('year', session()->get('fiscal_year'))->first();

        // Post data to database.
        $payment = Payment::Create([
            'fiscal_year_id' => $getFiscalYear->id
        ] + $request->validated());

        // Add data to the database.
        AdministratorPayment::Create([
            'admin_id' => auth()->user()->id,
            'payment_id' => $payment->id,
        ]);
        // Return back with message.
        return redirect()->route('payment.index')->with([
                'type' => 'success',
                'message' => __('Alert Add')
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        // Init view.
        return view('admin.modules.payment.createEdit', compact('payment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(PaymentRequest $request, Payment $payment)
    {
        // Set data to save into database.
        $payment->update($request->validated());

        // Save data.
        $payment->save();

        // Return back with message.
        return redirect()->route('payment.index')->with([
                'type' => 'success',
                'message' => __('Alert Edit')
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        // Delete the model.
        $payment->delete();

        // Return back with message.
        return redirect()->back()->with([
            'type' => 'success',
            'message' => __('Alert Delete')
        ]);
    }
}
