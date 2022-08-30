@section('meta')
<title>{{ config('app.name') }} | {{ (@$fixed_cost ? __('Edit') . ' ' . \Str::Lower(__('Fixed Cost')) . ': ' . $fixed_cost->name  : __('Fixed Cost') . ' ' . \Str::Lower(__('Add'))) }}</title>
@endsection

<x-adminLayout>

    <div class="{{ $cssNs }}">

        @include('admin.layouts.breadcrumb', [
            'title' => __('Fixed Cost'),
            'description' => (@$post ? __('Fixed Cost Introduction Edit') : __('Fixed Cost Introduction Add')),
            'breadcrum' => [
                __('Fixed Cost') => route('fixedcost.index'),
                (@$fixed_cost ? __('Edit') . ' ' . \Str::Lower(__('Fixed Cost')) . ': ' . $fixed_cost->name  : __('Fixed Cost') . ' ' . \Str::Lower(__('Add'))) => '#'
            ],
        ])

        @if ($errors->any())

            <div class="alert alert-fill-danger alert-dismissible fade show" role="alert">
                {{ __('Alert Error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
            </div>

        @endif

        <form class="form-content" method="post" action="{{ (@$fixed_cost ? route('fixedcost.update', $fixed_cost) : route('fixedcost.store')) }}">

            @csrf

            @if(@$fixed_cost)

            @method('PATCH')

            @endif

            <div class="row">

                <div class="col-md-12 grid-margin stretch-card">

                    <div class="card">

                        <div class="card-body">

                            <h6 class="card-title mt-4">{{ __('Fixed Cost') }}</h6>
                            <p class="mb-4 text-muted small">{{ __('Content Introduction Fixed Cost') }}</p>

                            <div class="col-md-12">

                                <x-form.input
                                    type="text"
                                    name="name"
                                    :label="__('Name')"
                                    :value="(old('name') ? old('name') : (@$fixed_cost ? $fixed_cost->name : null))"
                                    :row="true"
                                    :cols="['col-2', 'col-2']"
                                />

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="form-submit">
                <button type="submit" class="btn btn-primary">{{ (@$fixed_cost ? __('Edit') : __('Add')) }}</button>
            </div>

        </form>

    </div>

</x-adminLayout>
