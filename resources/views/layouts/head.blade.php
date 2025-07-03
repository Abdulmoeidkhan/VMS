<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" type="image/png" href="{{asset('assets/images/icons/Badar-icon-128x128.png')}}" />
<link rel="stylesheet" href="{{asset('assets/css/styles.min.css')}}" />
<?php $routesIncludedTable = array('pages.organizations','pages.organization','pages.mediaGroups','pages.mediaGroup','pages.hrGroups','pages.hrGroup','pages.addDepoGuestRender','pages.depoGroups','pages.depoGroup','pages.mediaAllStaff','pages.attandee','pages.programs','pages.essentials','governmentOrganization.index','governmentStaff.index'); ?>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="{{asset('assets/libs/jquery/dist/jquery.min.js')}}"></script>
@if(in_array(Route::currentRouteName(), $routesIncludedTable))
<script src="{{asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.23.0/bootstrap-table.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/akottr/dragtable@master/dragtable.css">
@endif