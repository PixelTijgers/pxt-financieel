<?php

// Controller namespacing.
namespace App\Http\Controllers\Admin\Modules;
use App\Http\Controllers\Controller;

// Facades.
use Yajra\Datatables\Datatables;
use Yajra\DataTables\Html\Builder;

// Models.
use App\Models\PaymentType;

// Request
use App\Http\Requests\PaymentTypeRequest;

// Traits
use App\Traits\DataTableActionsTrait;
use App\Traits\HasRightsTrait;

class PaymentTypeController extends Controller
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
            return DataTables::of(PaymentType::query())
            ->addColumn('action', function (PaymentType $payment_type) {
                return
                    '<div class="d-flex">' .
                        $this->setAction('paymenttype.index', $payment_type, 'view', 'payment-types', false) .
                        $this->setAction('paymenttype.edit', $payment_type, 'update', 'payment-types') .
                        $this->setAction('paymenttype.destroy', $payment_type, 'destroy', 'payment-types') .
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
        return view('admin.modules.payment-type.index', compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Init view.
        return view('admin.modules.payment-type.createEdit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentTypeRequest $request)
    {
        // Post data to database.
        PaymentType::Create($request->validated());

        // Return back with message.
        return redirect()->route('payment-types.index')->with([
                'type' => 'success',
                'message' => __('Alert Add')
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaymentType  $payment_type
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentType $payment_type)
    {
        // Init view.
        return view('admin.modules.payment-type.createEdit', compact('payment_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaymentType  $payment_type
     * @return \Illuminate\Http\Response
     */
    public function update(PaymentTypeRequest $request, PaymentType $payment_type)
    {
        // Set data to save into database.
        $payment_type->update($request->validated());

        // Save data.
        $payment_type->save();

        // Return back with message.
        return redirect()->route('payment-types.index')->with([
                'type' => 'success',
                'message' => __('Alert Edit')
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $payment_type
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentType $payment_type)
    {
        // Delete the model.
        $payment_type->delete();

        // Return back with message.
        return redirect()->back()->with([
            'type' => 'success',
            'message' => __('Alert Delete')
        ]);
    }
}
