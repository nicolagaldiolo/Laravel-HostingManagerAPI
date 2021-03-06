@extends('layouts.app')

@section('content')
    @component('components.title', ['back_url' => route('dashboard')])
        {{__('messages.service_types')}}
    @endcomponent

    <!-- END: Subheader -->
    <div class="m-content">

        <div class="m-portlet m-portlet--mobile">
            @component('components.tableHeader', [
                'title' => __('messages.all_service_types'),
                'icon' => 'flaticon-interface-6',
                'button' => __('messages.new_service_type'),
                'url' => route('service-types.create'),
                'newModal' => true,
                'dataTarget' => '',
                'moreAction' => false,
            ])
            @endcomponent
            <div class="m-portlet__body">

                <!--begin: Datatable -->
                <table id="serviceType_table" data-deleteall="{{route('service-types.destroy-all')}}" class="table m-table table-striped- table-bordered table-hover table-checkable">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>{{__('messages.name')}}</th>
                        <th>{{__('messages.actions')}}</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>

        <!-- END EXAMPLE TABLE PORTLET-->
    </div>

    @include('layouts.partials._modal')

@stop
