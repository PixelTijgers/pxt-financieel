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

                                <x-form.input
                                    type="text"
                                    name="name"
                                    :label="__('Name')"
                                    :value="(old('name') ? old('name') : (@$payment ? $payment->name : null))"
                                    :row="true"
                                    :cols="['col-2', 'col-10']"
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
