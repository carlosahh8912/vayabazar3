@props(['titles' => ['ID', 'TITLE1', 'ACTIONS']])


<div id="kt_table_users_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
    <div class="table-responsive">
        <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer" id="kt_table_users">
            <!--begin::Table head-->
            <thead>
                <!--begin::Table row-->
                <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">

                    @foreach ($titles as $title)
                        <th class="sorting" rowspan="1" colspan="1">
                            {{ $title }}
                        </th>
                    @endforeach

                </tr>
                <!--end::Table row-->
            </thead>
            <!--end::Table head-->
            <!--begin::Table body-->
            <tbody class="text-gray-600 fw-bold">
                {{ $slot }}
            </tbody>
            <!--end::Table body-->
        </table>
    </div>
</div>
