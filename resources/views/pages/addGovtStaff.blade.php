@auth
@extends('layouts.layout')
@section("content")
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/cropper/2.3.4/cropper.min.css'>
<style>
    .box {
        padding: 0.5em;
        width: 100%;
        margin: 0.5em;
    }

    .box-2 {
        padding: 0.5em;
        width: calc(100%/2 - 1em);
    }

    .hide {
        display: none;
    }

    img {
        max-width: 100%;
    }
</style>
<span id="alert-comp"></span>
<div class="row">
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <div class="table-responsive">
                    <form name="organizationStaffInfo" id="organizationStaffInfo" method="POST" onsubmit="sendingPostRequest(event,`{{
                    isset($organizationStaff->uid)? 
                    route('api.governmentStaff.update',$organizationStaff->uid):
                    route('api.governmentStaff.store')}}`,`{{isset($organizationStaff->uid)?'put':'post' }}`)">
                        <fieldset>
                            <legend>Add Govt Staff</legend>
                            @csrf
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="rank" class="form-label">Staff
                                                rank</label>
                                            <select name="rank" id="rank" class="form-select">
                                                <option value="" selected disabled hidden> Select Staff
                                                    rank
                                                </option>
                                                @foreach (\App\Models\Rank::all() as $rank)
                                                <option value="{{$rank->ranks_uid}}" {{isset($organizationStaff->
                                                    rank) ? ($organizationStaff->rank ==
                                                    $rank->ranks_name ? 'selected' : '')
                                                    : ''}}>{{isset($organizationStaff->rank)
                                                    ?$organizationStaff->rank:$rank->ranks_name}}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Name</label>
                                            <input name="name" type="text" class="form-control" id="name"
                                                placeholder="Name"
                                                value="{{isset($organizationStaff) ? $organizationStaff->name : ''}}"
                                                required />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="designation" class="form-label">Designation</label>
                                            <input name="designation" type="text" class="form-control" id="designation"
                                                placeholder="Designation"
                                                value="{{isset($organizationStaff) ? $organizationStaff->address : ''}}"
                                                required />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="identity" class="form-label">Identity Number</label>
                                            <input name="identity" type="text" class="form-control" id="identity"
                                                placeholder="Identity Number"
                                                value="{{isset($organizationStaff) ? $organizationStaff->identity : ''}}"
                                                onchange="isNumeric('identity')" title="Identity Number" required
                                                maxlength="15" required />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Address</label>
                                            <input name="address" type="text" class="form-control" id="address"
                                                placeholder="Address"
                                                value="{{isset($organizationStaff) ? $organizationStaff->address : ''}}"
                                                required />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="contact" class="form-label">Contact Number</label>
                                            <input name="contact" type="number" minlength='14' maxlength='14'
                                                class="form-control" id="contact" placeholder="Contact Number"
                                                value="{{isset($organizationStaff) ? $organizationStaff->contact : ''}}"
                                                minlength='0' maxlength='14' title="14 DIGIT PHONE NUMBER" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="invited_by" class="form-label">Staff
                                                Invited by</label>
                                            <select name="invited_by" id="invited_by" class="form-select">
                                                <option value="" selected disabled hidden> Select Invited By
                                                </option>
                                                @foreach (\App\Models\Invitees::all() as $invitees)
                                                <option value="{{$invitees->id}}" {{isset($organizationStaff->
                                                    invited_by ) ? ($organizationStaff->invited_by ==
                                                    $invitees->id ? 'selected' : '')
                                                    : ''}}>{{isset($organizationStaff->invited_by)
                                                    ?$organizationStaff->invited_by:$invitees->name}}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="staff_category" class="form-label">Staff Category
                                            </label>
                                            <select name="staff_category" id="staff_category" class="form-select">
                                                <option value="" selected disabled hidden> Staff Category
                                                </option>
                                                @foreach (\App\Models\StaffCategory::all() as $staffCat)
                                                <option value="{{$staffCat->id}}" {{isset($organizationStaff->
                                                    staff_category ) ? ($organizationStaff->staff_category ==
                                                    $staffCat->name ? 'selected' : '')
                                                    : ''}}>{{isset($organizationStaff->staff_category )
                                                    ?$organizationStaff->staff_category :$staffCat->name}}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="country" class="form-label">Country</label>
                                            <select name="country" id="country" class="form-select">
                                                <option value="" selected disabled hidden> Select Country
                                                </option>
                                                @foreach (\App\Models\Country::all() as $country)
                                                <option value="{{$country->id}}" {{isset($organizationStaff->
                                                    country) ? ($organizationStaff->country ==
                                                    $country->name ? 'selected' : '')
                                                    : ''}}>{{isset($organizationStaff->country)
                                                    ?$organizationStaff->country:$country->name}}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="city" class="form-label">City</label>
                                            <input name="city" type="text" class="form-control" id="city"
                                                placeholder="Karachi"
                                                value="{{isset($organizationStaff) ? $organizationStaff->city : ''}}"
                                                required />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="car_sticker_no" class="form-label">Car Sticker No.</label>
                                            <input name="car_sticker_no" type="text" minlength='4' maxlength='11'
                                                class="form-control" id="car_sticker_no" placeholder="Car Sticker Number"
                                                value="{{isset($organizationStaff) ? $organizationStaff->car_sticker_no : ''}}"
                                                minlength='4' maxlength='11' />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="car_sticker_color" class="form-label">Car Sticker Color</label>
                                            <select name="car_sticker_color" id="car_sticker_color" class="form-select">
                                                <option value="" selected disabled hidden> Select Car Sticker Color
                                                </option>
                                                <option value="Red" {{isset($organizationStaff->
                                                    car_sticker_color) ? ($organizationStaff->car_sticker_color ==
                                                    "Red"? 'selected' : '')
                                                    : ''}}>{{isset($organizationStaff->car_sticker_color)
                                                    ?$organizationStaff->car_sticker_color:"Red"}}
                                                <option value="Blue" {{isset($organizationStaff->
                                                    car_sticker_color) ? ($organizationStaff->car_sticker_color ==
                                                    "Blue"? 'selected' : '')
                                                    : ''}}>{{isset($organizationStaff->car_sticker_color)
                                                    ?$organizationStaff->car_sticker_color:"Blue"}}
                                                <option value="Yellow" {{isset($organizationStaff->
                                                    car_sticker_color) ? ($organizationStaff->car_sticker_color ==
                                                    "Yellow"? 'selected' : '')
                                                    : ''}}>{{isset($organizationStaff->car_sticker_color)
                                                    ?$organizationStaff->car_sticker_color:"Yellow"}}
                                                <option value="Green" {{isset($organizationStaff->
                                                    car_sticker_color) ? ($organizationStaff->car_sticker_color ==
                                                    "Green"? 'selected' : '')
                                                    : ''}}>{{isset($organizationStaff->car_sticker_color)
                                                    ?$organizationStaff->car_sticker_color:"Green"}}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label for="invitaion_no" class="form-label">Invitaion No.</label>
                                            <input name="invitaion_no" type="text" class="form-control"
                                                id="invitaion_no" placeholder="AE21466"
                                                value="{{isset($organizationStaff) ? $organizationStaff->invitaion_no : ''}}"
                                                title="Invitaion Number" minlength="5" maxlength="10" autocomplete="invitation_no" required />
                                        </div>
                                    </div>
                                </div>
                                <br />
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <input type="submit" name="submitMore"
                                                class="btn {{isset($organizationStaff->uid )?'btn-primary':'btn-success'}}"
                                                value="{{isset($organizationStaff->uid)?'Update Govt Staff & More':'Add Govt Staff & More'}}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    const sendingPostRequest = (event, route,type='post') => {
        event.preventDefault();
                const formData = new FormData(event.target);
        const formValues = {};

        // Process each entry in FormData
        formData.forEach((value, key) => {
            // Check if the key already exists in formValues
            if (formValues[key]) {
                // If the key already exists, ensure it is an array and add the new value
                if (Array.isArray(formValues[key])) {
                    formValues[key].push(value);
                } else {
                    formValues[key] = [formValues[key], value];
                }
            } else {
                // If the key does not exist, simply add it
                formValues[key] = value;
            }
        });

        const lengthOfForm = Object.keys(formValues).length; // Length Of Values getting from from 
    if(type=='post'){
    axios.post(route, formValues)
    .then(response => {
            console.log(response);
            document.getElementById('alert-comp').innerHTML = `
            <div class="alert alert-${response.data.success ? 'success' : 'danger'} alert-dismissible fade show" role="alert">
                <strong>${response.data.message}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>`;
                
                if (response.data.success) {
                    event.target.reset();
                }
            })
            .catch(error => {
                console.log(error);
                document.getElementById('alert-comp').innerHTML = `
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>An error occurred while processing your request.</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>`;
                })
                .finally(() => {
                    console.log('Request processing completed.');
                });
            }
            else{
                axios.put(route, formValues).then(response => {
            console.log(response);
            document.getElementById('alert-comp').innerHTML = `
            <div class="alert alert-${response.data.success ? 'success' : 'danger'} alert-dismissible fade show" role="alert">
                <strong>${response.data.message}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>`;
                
                if (!response.data.success) {
                    event.target.reset();
                }
            })
            .catch(error => {
                console.log(error);
                document.getElementById('alert-comp').innerHTML = `
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>An error occurred while processing your request.</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>`;
                })
                .finally(() => {
                    console.log('Request processing completed.');
                });
            }
        }
</script>
@endsection
@endauth