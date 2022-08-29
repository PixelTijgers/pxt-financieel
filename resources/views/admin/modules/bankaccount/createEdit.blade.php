@section('meta')
<title>{{ config('app.name') }} | {{ (@$bankaccount ? __('Edit') . ' ' . \Str::Lower(__('Bankaccount')) . ': ' . $bankaccount->name  : __('Bankaccount') . ' ' . \Str::Lower(__('Add'))) }}</title>
@endsection

<x-adminLayout>

    <div class="{{ $cssNs }}">

        @include('admin.layouts.breadcrumb', [
            'title' => __('Bankaccount'),
            'description' => (@$post ? __('Bankaccount Introduction Edit') : __('Bankaccount Introduction Add')),
            'breadcrum' => [
                __('Bankaccount') => route('bankaccount.index'),
                (@$bankaccount ? __('Edit') . ' ' . \Str::Lower(__('Bankaccount')) . ': ' . $bankaccount->name  : __('Bankaccount') . ' ' . \Str::Lower(__('Add'))) => '#'
            ],
        ])

        @if ($errors->any())

            <div class="alert alert-fill-danger alert-dismissible fade show" role="alert">
                {{ __('Alert Error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
            </div>

        @endif

        <form class="form-content" method="post" action="{{ (@$bankaccount ? route('bankaccount.update', $bankaccount) : route('bankaccount.store')) }}">

            @csrf

            @if(@$bankaccount)

            @method('PATCH')

            @endif

            <div class="row">

                <div class="col-md-12 grid-margin stretch-card">

                    <div class="card">

                        <div class="card-body">

                            <h6 class="card-title mt-4">{{ __('Bankaccount') }}</h6>
                            <p class="mb-4 text-muted small">{{ __('Content Introduction Bankaccount') }}</p>

                            <div class="col-md-12">

                                <x-form.input
                                    type="text"
                                    name="name"
                                    :label="__('Name')"
                                    :value="(old('name') ? old('name') : (@$bankaccount ? $bankaccount->name : null))"
                                    :row="true"
                                    :cols="['col-2', 'col-6']"
                                />

                                <x-form.input
                                    type="text"
                                    name="accountnumber"
                                    :label="__('Bankaccount')"
                                    :value="(old('accountnumber') ? old('accountnumber') : (@$bankaccount ? $bankaccount->accountnumber : null))"
                                    :row="true"
                                    :cols="['col-2', 'col-6']"
                                />

                                <x-form.select
                                    name="bankaccount_type_id"
                                    :label="__('Bankaccount Type')"
                                    :cols="['col-3', 'col-4']"
                                    :value="(old('bankaccount_type_id') ? old('bankaccount_type_id') : (@$bankaccount ? $bankaccount->bankaccount_type_id : null))"
                                    :options="\App\Models\BankaccountType::all()->sortBy('name')"
                                    :valueWrapper="['id', 'name']"
                                    :disabledOption="__('Bankaccount Type Select')"
                                    :row="true"
                                    :cols="['col-2', 'col-3']"
                                />

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="form-submit">
                <button type="submit" class="btn btn-primary">{{ (@$bankaccount ? __('Edit') : __('Add')) }}</button>
            </div>

        </form>

    </div>

</x-adminLayout>
