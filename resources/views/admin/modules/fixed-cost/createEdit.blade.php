@section('meta')
<title>{{ config('app.name') }} | {{ (@$fixed_cost ? __('Edit') . ' ' . \Str::Lower(__('Fixed Cost')) . ': ' . $fixed_cost->name  : __('Fixed Cost') . ' ' . \Str::Lower(__('Add'))) }}</title>
@endsection

<x-adminLayout>

    <div class="{{ $cssNs }}">

        @include('admin.layouts.breadcrumb', [
            'title' => __('Fixed Cost'),
            'description' => (@$post ? __('Fixed Cost Introduction Edit') : __('Fixed Cost Introduction Add')),
            'breadcrum' => [
                __('Fixed Cost') => route('fixed-cost.index'),
                (@$fixed_cost ? __('Edit') . ' ' . \Str::Lower(__('Fixed Cost')) . ': ' . $fixed_cost->name  : __('Fixed Cost') . ' ' . \Str::Lower(__('Add'))) => '#'
            ],
        ])

        @if ($errors->any())

            <div class="alert alert-fill-danger alert-dismissible fade show" role="alert">
                {{ __('Alert Error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
            </div>

        @endif

        <form class="form-content" method="post" action="{{ (@$fixed_cost ? route('fixed-cost.update', $fixed_cost) : route('fixed-cost.store')) }}">

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

                                <x-form.select
                                    name="bankaccount_id"
                                    :label="__('Bankaccount')"
                                    :cols="['col-2', 'col-3']"
                                    :value="(old('bankaccount_id') ? old('bankaccount_id') : (@$fixed_cost ? $fixed_cost->bankaccount_id : null))"
                                    :options="\App\Models\Bankaccount::all()->sortBy('name')"
                                    :valueWrapper="['id', 'name']"
                                    :disabledOption="'Selecteer rekening'"
                                    :row="true"
                                />

                                <x-form.select
                                    name="company_id"
                                    :label="__('Company')"
                                    :cols="['col-2', 'col-3']"
                                    :value="(old('company_id') ? old('company_id') : (@$fixed_cost ? $fixed_cost->company_id : null))"
                                    :options="\App\Models\Company::all()->sortBy('name')"
                                    :valueWrapper="['id', 'name']"
                                    :disabledOption="__('Company Select')"
                                    :row="true"
                                />

                                <x-form.select
                                    name="category_id"
                                    :label="__('Category')"
                                    :cols="['col-2', 'col-3']"
                                    :value="(old('category_id') ? old('category_id') : (@$fixed_cost ? $fixed_cost->category_id : null))"
                                    :options="\App\Models\Category::all()->sortBy('name')"
                                    :valueWrapper="['id', 'name']"
                                    :disabledOption="__('Category Select')"
                                    :row="true"
                                />

                                <x-form.input
                                    type="text"
                                    name="cost"
                                    :label="'Kosten'"
                                    :value="(old('cost') ? old('cost') : (@$fixed_cost ? $fixed_cost->cost : null))"
                                    :row="true"
                                    :cols="['col-2', 'col-2']"
                                />

                                <x-form.checkbox
                                    name="is_shared"
                                    :label="'Gedeelde kost'"
                                    :values="(@$fixed_cost ? $fixed_cost->is_shared : null)"
                                    :options="[
                                        1 => ''
                                    ]"
                                    :optionsTranslated="true"
                                    :row="true"
                                    :cols="['col-2', 'col-3']"
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
