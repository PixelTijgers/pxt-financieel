@section('meta')
<title>{{ config('app.name') }} | {{ __('Dashboard') }}</title>
    <meta name="description" content="{{ __('Dashboard Description') }}" />
@endsection

<x-admin-layout>

    <div class="{{ $cssNs }}">

                    @include('admin.layouts.breadcrumb', [
                        'title' => __('Dashboard'),
                        'description' => __('Dashboard Description'),
                        'breadcrum' => [
                            __('Dashboard') => '#',
                        ],
                    ])

                </div>

</x-admin-layout>
