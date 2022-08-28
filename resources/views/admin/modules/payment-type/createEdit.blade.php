@section('meta')
<title>{{ config('app.name') }} | {{ (@$payment_type ? __('Edit') . ' ' . \Str::Lower(__('Payment Type')) . ': ' . $payment_type->name  : __('Payment Type') . ' ' . \Str::Lower(__('Add'))) }}</title>
@endsection

<x-adminLayout>

    <div class="{{ $cssNs }}">

        @include('admin.layouts.breadcrumb', [
            'title' => __('Payment Type'),
            'description' => (@$post ? __('Payment Type Introduction Edit') : __('Payment Type Introduction Add')),
            'breadcrum' => [
                __('Payment Type') => route('payment-types.index'),
                (@$payment_type ? __('Edit') . ' ' . \Str::Lower(__('Payment Type')) . ': ' . $payment_type->name  : __('Payment Type') . ' ' . \Str::Lower(__('Add'))) => '#'
            ],
        ])

        @if ($errors->any())

            <div class="alert alert-fill-danger alert-dismissible fade show" role="alert">
                {{ __('Alert Error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
            </div>

        @endif

        <form class="form-content" method="post" action="{{ (@$payment_type ? route('payment-types.update', $payment_type) : route('payment-types.store')) }}">

            @csrf

            @if(@$payment_type)

            @method('PATCH')

            @endif

            <div class="row">

                <div class="col-md-12 grid-margin stretch-card">

                    <div class="card">

                        <div class="card-body">

                            <h6 class="card-title mt-4">{{ __('Payment Type') }}</h6>
                            <p class="mb-4 text-muted small">{{ __('Content Introduction Payment Type') }}</p>

                            <div class="col-md-12">

                                <x-form.input
                                    type="text"
                                    name="name"
                                    :label="__('Name')"
                                    :value="(old('name') ? old('name') : (@$payment_type ? $payment_type->name : null))"
                                    :row="true"
                                    :cols="['col-2', 'col-10']"
                                />

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="form-submit">
                <button type="submit" class="btn btn-primary">{{ (@$payment_type ? __('Edit') : __('Add')) }}</button>
            </div>

        </form>

    </div>

</x-adminLayout>
