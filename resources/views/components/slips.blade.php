<div>
    @if($attandees)
    <link rel="stylesheet" href="{{asset('assets/css/styles.min.css')}}" />
    <div class="d-flex align-items-start justify-content-center slipComponent">
        <div class="row w-100">
            <div class="col-md-12 col-lg-6 col-xxl-3">
                <div class="card-body">
                    <img src="https://ideaspakistan.gov.pk/wp-content/uploads/2024/01/ideas_logo_2024-1.png" width="180" class="d-block mx-auto" alt="Ideas Logo">
                    <p class="text-center">{{date("Y-m-d")}} : {{date("H:i:s")}}</p>
                    <h2 class="text-center">{{$attandees['name']}}</h2>
                    <h3 class="text-center">{{$attandees['designation']}}</h3>
                    <h3 class="text-center">{{$attandees['attandeeCompany']}}</h3>
                    <p class="text-center">{{$attandees['attandeeCountry']}}</p>
                    <p class="text-center">{{$attandees['identity']}}</p>
                    <div class="d-flex my-1 justify-content-center">
                        <div id="barCode" class="barcode-list" custom-id="{{$attandees['code']}}"></div>
                    </div>
                    <p class="text-center">You can collect your badge from next counter by presenting this Slip</p>
                    <p class="text-center">Powered by Badar Expo Solutions</p>
                    <br />
                </div>
            </div>
        </div>
    </div>
    @endif
</div>