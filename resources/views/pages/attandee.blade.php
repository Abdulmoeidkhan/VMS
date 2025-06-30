@auth
@extends('layouts.layout')
@section("content")
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
        background-color: var(--bs-success);
        font-weight: bold;
    }

    .rejected {
        background-color: var(--bs-badar);
        font-weight: bold;
        color: black;
    }

    .approved {
        background-color: var(--bs-success);
        font-weight: bold;
        color: white;
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
    <div class="card w-100">
        <div class="card-body p-4">
            <div class="row">
                <div class="card w-100">
                    <div class="card-body p-4">
                        <div class="card-title fw-semibold mb-4 d-flex justify-content-end">
                            <!-- <span>
                                Attendance Panel
                            </span> -->
                            <span class="row">
                                <livewire:search-attandee-component />
                                <livewire:add-attandee-component :isNew='true' :visitorUid='""'/>
                            </span>
                        </div>
                        <livewire:attandee-list-component />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if(session()->get('user')->roles[0]->name === "admin" || session()->get('user')->roles[0]->name === "bxssUser")
<div class="row">
    <div class="card w-100">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table id="table" data-filter-control-multiple-search="true"
                    data-filter-control-multiple-search-delimiter="," data-virtual-scroll="true"
                    data-filter-control="true" data-toggle="table" data-flat="true" data-pagination="true"
                    data-show-toggle="true" data-show-export="true" data-show-columns="true" data-show-refresh="true"
                    data-show-pagination-switch="true" data-show-columns-toggle-all="true" data-row-style="rowStyle"
                    data-print-as-filtered-and-sorted-on-ui="true" data-show-print="true"
                    data-page-list="[10, 25, 50, 100]" data-reorderable-columns="true" data-url="{{route('visitors.index')}}">
                    <thead>
                        <tr>
                            <th data-filter-control="input" data-field="SNO" data-formatter="operateSerial">S.No.</th>
                            <th data-filter-control="input" data-field="name" data-sortable="true"
                                data-formatter="operateText">Name</th>
                            <th data-filter-control="input" data-field="attandeeCompany" data-sortable="true"
                                data-formatter="operateText">Company/Institute Name</th>
                            <th data-filter-control="input" data-field="attandeeCountry" data-sortable="true"
                                data-formatter="operateText">Country Name</th>
                            <th data-filter-control="input" data-field="designation" data-sortable="true"
                                data-formatter="operateText">Designation</th>
                            <!-- <th data-filter-control="input" data-field="dob" data-sortable="true"
                                data-formatter="operateText">Date Of Birth</th> -->
                            <th data-filter-control="input" data-field="identity" data-sortable="true"
                                data-formatter="operateText">Identity</th>
                            <th data-filter-control="input" data-field="contact" data-sortable="true"
                                data-formatter="operateText">Contact</th>
                            <th data-filter-control="input" data-field="email" data-sortable="true"
                                data-formatter="operateText">Email</th>
                            <th data-filter-control="input" data-field="code" data-sortable="true"
                                data-formatter="operateText">Code</th>
                            <th data-filter-control="input" data-field="day_1" data-sortable="true"
                                data-formatter="statusFormatter">Day 1</th>
                            <th data-filter-control="input" data-field="day_2" data-sortable="true"
                                data-formatter="statusFormatter">Day 2</th>
                            <th data-filter-control="input" data-field="day_3" data-sortable="true"
                                data-formatter="statusFormatter">Day 3</th>
                            <th data-filter-control="input" data-field="seminar" data-sortable="true"
                                data-formatter="statusFormatter">Seminar</th>
                            <th data-filter-control="input" data-field="day_4" data-sortable="true"
                                data-formatter="statusFormatter">Day 4</th>
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
    function operateSerial(value, row, index) {
        return index + 1;
    }

    function operateText(value, row, index) {
        return value ? value : "N/A"
    }

    function operateDate(value, row, index) {
        return value ? value.slice(0, 10) : "N/A"
    }

    function statusFormatter(value, row, index) {
        if (value != null) {
            return value ? ['<div class="left">', 'Yes', '</div>'].join('') : ['<div class="left">', 'No', '</div>'].join('');
        }
    }

    ['#table'].map((val => {
        var $table = $(val)
        $(val).bootstrapTable({
            printPageBuilder: function(val) {
                return `
<html>
  <head>
  <style type="text/css" media="print">
  @page {
    size: auto;
    margin: 25px 0 25px 0;
  }
  </style>
  <style type="text/css" media="all">
  table {
    border-collapse: collapse;
    font-size: 12px;
  }
  table, th, td {
    border: 1px solid grey;
  }
  th, td {
    text-align: center;
    vertical-align: middle;
  }
  p {
    font-weight: bold;
    margin-left:20px;
  }
  table {
    width:94%;
    margin-left:3%;
    margin-right:3%;
  }
  div.bs-table-print {
    text-align:center;
  }
  </style>
  </head>
  <title>Print Table</title>
  <body>
  <div class="bs-table-print">${val}</div>
  </body>
</html>`
            }
        })
    }))
</script>
@endif
@endsection
@endauth