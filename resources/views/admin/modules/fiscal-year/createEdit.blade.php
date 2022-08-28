@section('meta')
<title>{{ config('app.name') }} | {{ (@$fiscal_year ? __('Edit') . ' ' . \Str::Lower(__('Fiscal Year')) . ': ' . $fiscal_year->name  : __('Fiscal Year') . ' ' . \Str::Lower(__('Add'))) }}</title>
@endsection

<x-adminLayout>

    <div class="{{ $cssNs }}">

        @include('admin.layouts.breadcrumb', [
            'title' => __('Fiscal Year'),
            'description' => (@$post ? __('Fiscal Year Introduction Edit') : __('Fiscal Year Introduction Add')),
            'breadcrum' => [
                __('Fiscal Year') => route('fiscal-year.index'),
                (@$fiscal_year ? __('Edit') . ' ' . \Str::Lower(__('Fiscal Year')) . ': ' . $fiscal_year->name  : __('Fiscal Year') . ' ' . \Str::Lower(__('Add'))) => '#'
            ],
        ])

        @if ($errors->any())

            <div class="alert alert-fill-danger alert-dismissible fade show" role="alert">
                {{ __('Alert Error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
            </div>

        @endif

        <form class="form-content" method="post" action="{{ (@$fiscal_year ? route('fiscal-year.update', $fiscal_year) : route('fiscal-year.store')) }}">

            @csrf

            @if(@$fiscal_year)

            @method('PATCH')

            @endif

            <div class="row">

                <div class="col-md-12 grid-margin stretch-card">

                    <div class="card">

                        <div class="card-body">

                            <h6 class="card-title mt-4">{{ __('Fiscal Year') }}</h6>
                            <p class="mb-4 text-muted small">{{ __('Content Introduction Fiscal Year') }}</p>

                            <div class="col-md-12">

                                <x-form.input
                                    type="text"
                                    name="year"
                                    :label="__('Fiscal Year')"
                                    :value="(old('year') ? old('year') : (@$fiscal_year ? $fiscal_year->year : null))"
                                    :row="true"
                                    :cols="['col-2', 'col-2']"
                                />

                                <x-form.input
                                    type="text"
                                    name="name"
                                    :label="__('Name')"
                                    :value="(old('name') ? old('name') : (@$fiscal_year ? $fiscal_year->name : null))"
                                    :row="true"
                                    :cols="['col-2', 'col-2']"
                                />

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="form-submit">
                <button type="submit" class="btn btn-primary">{{ (@$fiscal_year ? __('Edit') : __('Add')) }}</button>
            </div>

        </form>

    </div>

</x-adminLayout>
