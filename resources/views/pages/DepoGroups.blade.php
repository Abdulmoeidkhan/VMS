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
                <h5 class="card-title text-center mb-9 fw-semibold">Total Depo Guest Updated</h5>
                <h4 class="d-flex justify-content-center mb-9 fw-semibold">
                    {{$StaffCount}}
                </h4>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="card w-100">
        <div class="card-body p-4">
            @if(session()->get('user')->roles[0]->name === "admin" || session()->get('user')->roles[0]->name === "depo" || session()->get('user')->roles[0]->name === "bxssUser")
            <div class="row">
                <div class="d-flex">
                    <a type="button" href="{{route('pages.addDepoGroup')}}" class="btn btn-primary">Add
                        Organization</a>&nbsp;
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
                    data-page-list="[10, 25, 50, 100]" data-reorderable-columns="true" data-url="{{route('request.getDepoGroups')}}">
                    <thead>
                        <tr>
                            <th data-filter-control="input" data-field="SNO" data-formatter="operateSerial">S.No.</th>
                            @if(session()->get('user')->roles[0]->name === "admin" ||
                            session()->get('user')->roles[0]->name === "depo")
                            <th data-field="uid" data-formatter="operateGuest">Staff</th>
                            <th data-field="uid" data-formatter="operateEdit">Edit</th>
                            @endif
                            <th data-filter-control="input" data-field="staff_quantity" data-sortable="true"
                                data-formatter="operateDigits">Allowed Quantity</th>
                            <th data-filter-control="input" data-field="depo_rep_name" data-sortable="true"
                                data-fixed-columns="true" data-formatter="operateText">Org Name</th>
                            <th data-filter-control="input" data-field="depo_category" data-sortable="true"
                                data-fixed-columns="true" data-formatter="operateText">Badge Category</th>
                            <th data-filter-control="input" data-field="guestCount" data-sortable="true"
                                data-formatter="operateDigits">No. Of Persons</th>
                            <th data-filter-control="input" data-field="depo_rep_email" data-formatter="operateEmail">
                                Registered Email</th>
                            <th data-filter-control="input" data-field="depo_rep_contact" data-sortable="true"
                                data-formatter="operateDigits">Org Contact</th>
                            <th data-filter-control="input" data-field="depo_rep_phone" data-sortable="true"
                                data-formatter="operateText">Phone</th>
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


    function operateGuest(value, row, index) {
        if (value) {
            return [
                '<div class="left">',
                '<a class="btn btn-primary" href="depoGroup/' + value + '">',
                '<i class="ti ti-users" style="font-size:22px; widht:24px; height:24px;"></i>',
                '</a>',
                '</div>'
            ].join('')
        }
    }

    function operateEdit(value, row, index) {
        if (value) {
            return [
                '<div class="left">',
                '<a class="btn btn-success" href="addDepoGroup/' + value + '">',
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

        function rowStyle(row) {
            if (row.functionaryPending != 0) {
                return {
                    classes: 'pending'
                }
            }
            return {}
        }

        $(val).bootstrapTable({
            exportOptions: {
                fileName: 'List Of All Hr Groups'
            }
        });
    }))
</script>
@endsection
@endauth