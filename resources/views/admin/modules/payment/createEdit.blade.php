@section('meta')
<title>{{ config('app.name') }} | {{ (@$payment ? __('Edit') . ' ' . \Str::Lower(__('Payment')) . ': ' . $payment->name  : __('Payment') . ' ' . \Str::Lower(__('Add'))) }}</title>
@endsection

<x-adminLayout>

    <div class="{{ $cssNs }}">

        @include('admin.layouts.breadcrumb', [
            'title' => __('Payment'),
            'description' => (@$post ? __('Payment Introduction Edit') : __('Payment Introduction Add')),
            'breadcrum' => [
                __('Payment') => route('payment.index'),
                (@$payment ? __('Edit') . ' ' . \Str::Lower(__('Payment')) . ': ' . $payment->name  : __('Payment') . ' ' . \Str::Lower(__('Add'))) => '#'
            ],
        ])

        @if ($errors->any())

            <div class="alert alert-fill-danger alert-dismissible fade show" role="alert">
                {{ __('Alert Error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
            </div>

        @endif

        <form class="form-content" method="post" action="{{ (@$payment ? route('payment.update', $payment) : route('payment.store')) }}">

            @csrf

            @if(@$payment)

            @method('PATCH')

            @endif

            <div class="row">

                <div class="col-md-12 grid-margin stretch-card">

                    <div class="card">

                        <div class="card-body">

                            <h6 class="card-title mt-4">{{ __('Payment') }}</h6>
                            <p class="mb-4 text-muted small">{{ __('Content Introduction Payment') }}</p>

                            <div class="col-md-12">

                                <x-form.select
                                    name="payment_type_id"
                                    :label="__('Payment Type')"
                                    :cols="['col-2', 'col-3']"
                                    :value="(old('payment_type_id') ? old('payment_type_id') : (@$payment ? $payment->payment_type_id : null))"
                                    :options="\App\Models\PaymentType::all()->sortBy('name')"
                                    :valueWrapper="['id', 'name']"
                                    :disabledOption="__('Payment Type Select')"
                                    :row="true"
                                />

                                <x-form.select
                                    name="category_id"
                                    :label="__('Category')"
                                    :cols="['col-2', 'col-3']"
                                    :value="(old('category_id') ? old('category_id') : (@$payment ? $payment->category_id : null))"
                                    :options="\App\Models\Category::all()->sortBy('name')"
                                    :valueWrapper="['id', 'name']"
                                    :disabledOption="__('Category Select')"
                                    :row="true"
                                />

                                <x-form.date
                                    name="payment_date"
                                    :label="__('Payment Date')"
                                    :value="(old('payment_date') ? old('payment_date') : (@$payment ? $payment->payment_date : null))"
                                    :row="true"
                                    :cols="['col-2', 'col-3']"
                                />

                                <x-form.input
                                    type="text"
                                    name="company"
                                    :label="__('Company')"
                                    :value="(old('company') ? old('company') : (@$payment ? $payment->company : null))"
                                    :row="true"
                                    :cols="['col-2', 'col-6']"
                                />

                                <x-form.input
                                    type="text"
                                    name="payment_reference"
                                    :label="__('Payment Reference')"
                                    :value="(old('payment_reference') ? old('payment_reference') : (@$payment ? $payment->payment_reference : null))"
                                    :row="true"
                                    :cols="['col-2', 'col-6']"
                                />

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="form-submit">
                <button type="submit" class="btn btn-primary">{{ (@$payment ? __('Edit') : __('Add')) }}</button>
            </div>

        </form>

    </div>

</x-adminLayout>
