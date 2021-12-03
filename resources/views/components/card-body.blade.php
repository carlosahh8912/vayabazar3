@props(['card_title' => null, 'toolbar' => null, 'card_footer' => null])

<!--begin::Card-->
<div class="card">
    <!--begin::Card header-->
    <div class="card-header border-0 pt-6">
        <!--begin::Card title-->
        <div class="card-title">
            {{ $card_title }}
        </div>
        <!--begin::Card title-->
        <!--begin::Card toolbar-->
    <div class="card-toolbar">
        <!--begin::Toolbar-->
        <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
            {{ $toolbar }}
        </div>
    </div>
    <!--end::Card toolbar-->
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body pt-0">
        <!--begin::Table-->
        {{ $slot }}
        <!--end::Table-->
    </div>
    <!--end::Card body-->
    <!--begin::Card body-->
    <div class="card-footer">
        <!--begin::Table-->
        {{ $card_footer }}
        <!--end::Table-->
    </div>
    <!--end::Card body-->
</div>
<!--end::Card-->


