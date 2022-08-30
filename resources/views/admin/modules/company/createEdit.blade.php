@section('meta')
<title>{{ config('app.name') }} | {{ (@$company ? __('Edit') . ' ' . \Str::Lower(__('Company')) . ': ' . $company->name  : __('Company') . ' ' . \Str::Lower(__('Add'))) }}</title>
@endsection

<x-adminLayout>

    <div class="{{ $cssNs }}">

        @include('admin.layouts.breadcrumb', [
            'title' => __('Company'),
            'description' => (@$post ? __('Company Introduction Edit') : __('Company Introduction Add')),
            'breadcrum' => [
                __('Company') => route('company.index'),
                (@$company ? __('Edit') . ' ' . \Str::Lower(__('Company')) . ': ' . $company->name  : __('Company') . ' ' . \Str::Lower(__('Add'))) => '#'
            ],
        ])

        @if ($errors->any())

            <div class="alert alert-fill-danger alert-dismissible fade show" role="alert">
                {{ __('Alert Error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
            </div>

        @endif

        <form class="form-content" method="post" action="{{ (@$company ? route('company.update', $company) : route('company.store')) }}">

            @csrf

            @if(@$company)

            @method('PATCH')

            @endif

            <div class="row">

                <div class="col-md-12 grid-margin stretch-card">

                    <div class="card">

                        <div class="card-body">

                            <h6 class="card-title mt-4">{{ __('Company') }}</h6>
                            <p class="mb-4 text-muted small">{{ __('Content Introduction Company') }}</p>

                            <div class="col-md-12">

                                <x-form.input
                                    type="text"
                                    name="name"
                                    :label="__('Name')"
                                    :value="(old('name') ? old('name') : (@$company ? $company->name : null))"
                                    :row="true"
                                    :cols="['col-2', 'col-10']"
                                />

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="form-submit">
                <button type="submit" class="btn btn-primary">{{ (@$company ? __('Edit') : __('Add')) }}</button>
            </div>

        </form>

    </div>

</x-adminLayout>
