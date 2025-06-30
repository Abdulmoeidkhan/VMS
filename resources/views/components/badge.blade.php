<div class="badge-parent row badge-print-{{$componentKey}}" style="padding: 0px 20px;">
    <div class="d-flex align-items-end">
        <div class="card-border" style="max-width:280px;">
            <div class="logo-child">
                <div>
                    <h5 class="text-left mx-3 my-0">
                        {{$badgeData->staff_first_name}} {{$badgeData->staff_last_name}}

                    </h5>
                    <h6 class="text-left mx-3 my-0">
                        {{$badgeData->staff_designation}}
                    </h6>
                    <h6 class="text-left mx-3 my-0">
                        {{$badgeData->companyName?->company_name}}
                    </h6>
                </div>
            </div>
            <div class="d-flex my-1">
                <div id="barCode-{{$componentKey}}" class="barcode-list" custom-id="{{$badgeData->code}}"></div>
            </div>
            <div class="card-border">
                <div class="logo-child">
                    <div>
                        <h6 class="text-left mx-3">
                            {{$badgeData->staff_identity}}/{{$badgeData->code}}/{{$badgeData->staff_country}}
                        </h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-border mx-4 mb-3">
            <div class="logo-child mx-5 ">
                @if($badgeData->image)
                {{-- <img src="https://res.cloudinary.com/dj6mfrbth/image/upload/Images/{{$badgeData->uid}}.png" --}}
                <img src="{{asset('storage/images/'. $badgeData->uid . '.png');}}"
                    style="height: 120px; width: 100px;" class="img-fluid" alt="Picture" onerror="this.style.display='none'"/>
                @endif
            </div>
        </div>
    </div>
</div>