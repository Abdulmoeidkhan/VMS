@auth
@extends('layouts.layout')
@section("content")
@if (session('error'))
<script>
    alert("{{session('error')}}");
</script>
@endif
<style>
    body {
        font-family: Arial;
    }

    /* Style the tab */
    .tab {
        overflow: hidden;
        border: 1px solid #ccc;
        background-color: #f1f1f1;
    }

    .active {
        color: green;
        font-weight: bold;
    }

    .pending {
        background-color: var(--bs-warning);
        font-weight: bold;
    }

    /* Style the buttons inside the tab */
    .tab button {
        background-color: inherit;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
        transition: 0.3s;
        font-size: 17px;
    }

    /* Change background color of buttons on hover */
    .tab button:hover {
        background-color: #ddd;
    }

    /* Create an active/current tablink class */
    .tab button.active {
        background-color: #ccc;
    }

    /* Style the tab content */
    .tabcontent {
        display: none;
        padding: 0px 12px;
        border: 1px solid #ccc;
        border-top: none;
    }
</style>

<div class="row">
    <div class="d-flex col-md-4 col-sm-2">
        <div class="card overflow-hidden">
            <div class="card-body p-4">
                <h5 class="card-title text-center mb-9 fw-semibold">Total Staff Updated</h5>
                <h4 class="d-flex justify-content-center mb-9 fw-semibold">
                    {{$StaffCount}}
                </h4>
            </div>
        </div>
    </div>
    <div class="d-flex col-md-4 col-sm-2">
        <div class="card overflow-hidden">
            <div class="card-body p-4">
                <h5 class="card-title text-center mb-9 fw-semibold">Total Functionary Staff</h5>
                <h4 class="d-flex justify-content-center mb-9 fw-semibold">
                    {{$FunctionaryCount}}
                </h4>
            </div>
        </div>
    </div>
    <div class="d-flex col-md-4 col-sm-2">
        <div class="card overflow-hidden">
            <div class="card-body p-4">
                <h5 class="card-title text-center mb-9 fw-semibold">Total Temporary Staff</h5>
                <h4 class="d-flex justify-content-center mb-9 fw-semibold">
                    {{$TemporaryCount}}
                </h4>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="card w-100">
        <div class="card-body p-4">
            @if(session()->get('user')->roles[0]->name === "admin" || session()->get('user')->roles[0]->name === "bxssUser")
            <div class="row">
                <div class="d-flex">
                    <a type="button" href="{{route('pages.addOrganization')}}" class="btn btn-primary">Add
                        Organisation</a>&nbsp;
                </div>
            </div>
            @endif
            <br />
            <div class="table-responsive">
                <table id="table" data-filter-control-multiple-search="true"
                    data-filter-control-multiple-search-delimiter="," data-virtual-scroll="true"
                    data-filter-control="true" data-toggle="table" data-flat="true" data-pagination="true"
                    data-show-toggle="true" data-show-export="true" data-show-columns="true" data-show-refresh="true"
                    data-show-pagination-switch="true" data-show-columns-toggle-all="true" data-row-style="rowStyle"
                    data-page-list="[10, 25, 50, 100]" data-reorderable-columns="true" data-url="{{route('request.getOrganizations')}}">
                    <thead>
                        <tr>
                            <th data-filter-control="input" data-field="SNO" data-formatter="operateSerial">S.No.</th>
                            @if(session()->get('user')->roles[0]->name === "admin" || session()->get('user')->roles[0]->name === "bxssUser")
                            <th data-field="uid" data-formatter="operateEdit">Staff</th>
                            <th data-field="uid" data-formatter="operateOrganization">Edit</th>
                            @endif
                            <th data-filter-control="input" data-field="staff_quantity" data-sortable="true"
                                data-formatter="operateDigits">Allowed Quantity</th>
                            <th data-filter-control="input" data-field="functionaryCount" data-sortable="true"
                                data-formatter="operateDigits">Functionaries</th>
                            <th data-filter-control="input" data-field="temporaryCount" data-sortable="true"
                                data-formatter="operateDigits">Temporaries</th>
                            <th data-filter-control="input" data-field="functionarySent" data-sortable="true"
                                data-formatter="operateDigits">Sent</th>
                            <th data-filter-control="input" data-field="functionaryPending" data-sortable="true"
                                data-formatter="operateDigits">Pending</th>
                            <th data-filter-control="input" data-field="functionaryApproved" data-sortable="true"
                                data-formatter="operateDigits">Approved</th>
                            <th data-filter-control="input" data-field="functionaryRejection" data-sortable="true"
                                data-formatter="operateDigits">Rejected</th>
                            <th data-filter-control="input" data-field="company_category" data-sortable="true"
                                data-fixed-columns="true" data-formatter="operateSpecialText">Company Category</th>
                            {{-- <th data-filter-control="input" data-field="company_type" data-sortable="true"
                                data-fixed-columns="true" data-formatter="operateText">Company Type</th> --}}
                            <th data-filter-control="input" data-field="company_name" data-sortable="true"
                                data-fixed-columns="true" data-formatter="operateText">Company Name</th>
                            <th data-filter-control="input" data-field="company_rep_email"
                                data-formatter="operateEmail">
                                Registered Email</th>
                            <th data-filter-control="input" data-field="company_owner" data-formatter="operateText">
                                Company Owner Name</th>
                            <th data-filter-control="input" data-field="company_owner_designation" data-sortable="true"
                                data-formatter="operateText">Company Owner Designation</th>
                            <th data-filter-control="input" data-field="company_owner_contact" data-sortable="true"
                                data-formatter="operateDigits">Company Owner Contact</th>
                            <th data-filter-control="input" data-field="company_address" data-sortable="true"
                                data-fixed-columns="true" data-formatter="operateText">Company Address </th>
                            <th data-filter-control="input" data-field="company_country" data-sortable="true"
                                data-formatter="operateText">Country</th>
                            <th data-filter-control="input" data-field="company_city" data-sortable="true"
                                data-formatter="operateText">City</th>
                            <th data-filter-control="input" data-field="company_contact" data-sortable="true"
                                data-formatter="operateText">Contact</th>
                            {{-- <th data-filter-control="input" data-field="company_ntn" data-sortable="true"
                                data-formatter="operateText">NTN</th> --}}
                            <th data-filter-control="input" data-field="company_rep_name" data-sortable="true"
                                data-formatter="operateText">Account Name</th>
                            {{-- <th data-filter-control="input" data-field="company_rep_designation"
                                data-sortable="true" data-formatter="operateText">Company Rep Designation</th>
                            <th data-filter-control="input" data-field="company_rep_dept" data-formatter="operateText">
                                Company Rep Department</th> --}}
                            <th data-filter-control="input" data-field="company_rep_contact"
                                data-formatter="operateText">Account Contact Number</th>
                            {{-- <th data-filter-control="input" data-field="company_rep_phone"
                                data-formatter="operateText">
                                Company Rep Phone</th> --}}
                            <th data-filter-control="input" data-field="created_at" data-sortable="true"
                                data-formatter="operateDate">Created At</th>
                            <th data-filter-control="input" data-field="updated_at" data-sortable="true"
                                data-formatter="operateDate">Last Updated
                            </th>

                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@include("layouts.tableFoot")
<script>
    function operateText(value, row, index) {
        return value ? `<span style="text-capitalize">${value.toString().replace(/[^\w ]/, " ")}</span>` : "N/A"
    }

    function operateDigits(value, row, index) {
        return value ? value : 0
    }

    function operateDate(value, row, index) {
        return value ? value.slice(0, 10) : "N/A"
    }


    function operateEmail(value, row, index) {
        return value ? `<span style="text-capitalize">${value.toString()}</span>` : "N/A"
    }

    function operateSpecialText(value, row, index) {
        return value ? value : "N/A"
    }

    function operateFirstAndLastName(value, row, index) {
        return `${row.first_Name} ${row.last_Name}`;
    }

    function statusChangerFormatter(value, row, index) {
        if (value) {
            return [
                '<div class="left">',
                '<a class="btn btn-danger" href="statusChanger/' + row.uid + '">',
                '<span><i class="ti ti-users" style="font-size:24px;"></i></span>',
                '</a>',
                '</div>',
            ].join('')
        } else {
            return [
                '-',
            ].join('')
        }
    }

    function statusFormatter(value, row, index) {
        if (value != null) {
            return value ? ['<div class="left">', 'Yes', '</div>'].join('') : ['<div class="left">', 'No', '</div>'].join('');
        }
    }


    function operateEdit(value, row, index) {
        if (value) {
            return [
                '<div class="left">',
                '<a class="btn btn-primary" href="organization/' + value + '">',
                '<i class="ti ti-users" style="font-size:22px; widht:24px; height:24px;"></i>',
                '</a>',
                '</div>'
            ].join('')
        }
    }

    function operateOrganization(value, row, index) {
        if (value) {
            return [
                '<div class="left">',
                '<a class="btn btn-success" href="addOrganization/' + value + '">',
                '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">',
                '<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>',
                '<path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>',
                '<path d="M6 21v-2a4 4 0 0 1 4 -4h3.5"></path>',
                '<path d="M18.42 15.61a2.1 2.1 0 0 1 2.97 2.97l-3.39 3.42h-3v-3l3.42 -3.39z"></path>',
                '</svg>',
                '</a>',
                '</div>'
            ].join('')
        }
    }


    function operateSerial(value, row, index) {
        return index + 1;
    }

    function rowStyle(row) {
        if (row.functionaryPending != 0) {
            return {
                classes: 'pending'
            }
        }
        return {}
    }


    ['#table'].map((val => {
        var $table = $(val)
        var selectedRow = {}

        $(function() {
            $table.on('click-row.bs.table', function(e, row, $element) {
                selectedRow = row
                $('.active').removeClass('active')
                $($element).addClass('active')
            })
        })

        $(val).bootstrapTable({
            exportOptions: {
                fileName: 'List Of All Organisation'
            }
        });
    }))
</script>
@endsection
@endauth