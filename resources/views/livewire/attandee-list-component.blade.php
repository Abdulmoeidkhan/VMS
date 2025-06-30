<div class="table-responsive">
    <table class="table text-nowrap mb-0 align-middle">
        <thead class="text-dark fs-4">
            <tr>
                <th class="border-bottom-0 display: flex; justify-content: center; align-items: center;">
                    <h6 class="fw-semibold mb-0">Name</h6>
                </th>
                <th class="border-bottom-0 display: flex; justify-content: center; align-items: center;">
                    <h6 class="fw-semibold mb-0">Company/Institute Name</h6>
                </th>
                <th class="border-bottom-0 display: flex; justify-content: center; align-items: center;">
                    <h6 class="fw-semibold mb-0">Country Name</h6>
                </th>
                <th class="border-bottom-0 display: flex; justify-content: center; align-items: center;">
                    <h6 class="fw-semibold mb-0">Designation</h6>
                </th>
                <th class="border-bottom-0 display: flex; justify-content: center; align-items: center;">
                    <h6 class="fw-semibold mb-0">Identity</h6>
                </th>
                <!-- <th class="border-bottom-0 display: flex; justify-content: center; align-items: center;">
                    <h6 class="fw-semibold mb-0">DOB</h6>
                </th> -->
                <th class="border-bottom-0 display: flex; justify-content: center; align-items: center;">
                    <h6 class="fw-semibold mb-0">Code</h6>
                </th>
                @if(session()->get('user')->roles[0]->name =="attandeeUser" ||session()->get('user')->roles[0]->name =="admin" ||session()->get('user')->roles[0]->name =="bxssUser" || session()->get('user')->roles[0]->name =="depo")
                <th class="border-bottom-0 display: flex; justify-content: center; align-items: center;">
                    <h6 class="fw-semibold mb-0">1st Day</h6>
                </th>
                <th class="border-bottom-0 display: flex; justify-content: center; align-items: center;">
                    <h6 class="fw-semibold mb-0">2nd Day</h6>
                </th>
                <th class="border-bottom-0 display: flex; justify-content: center; align-items: center;">
                    <h6 class="fw-semibold mb-0">3rd Day</h6>
                </th>
                <th class="border-bottom-0 display: flex; justify-content: center; align-items: center;">
                    <h6 class="fw-semibold mb-0">4th Day</h6>
                </th>
                <th class="border-bottom-0 display: flex; justify-content: center; align-items: center;">
                    <h6 class="fw-semibold mb-0">Seminar</h6>
                </th>
                @endif
                @if(session()->get('user')->roles[0]->name =="admin" ||session()->get('user')->roles[0]->name =="bxssUser" || session()->get('user')->roles[0]->name =="depo"|| session()->get('user')->roles[0]->name =="batchUser")
                <th class="border-bottom-0 display: flex; justify-content: center; align-items: center;">
                    <h6 class="fw-semibold mb-0">Edit</h6>
                </th>
                <th class="border-bottom-0 display: flex; justify-content: center; align-items: center;">
                    <h6 class="fw-semibold mb-0">Badge Print</h6>
                </th>
                <th class="border-bottom-0 display: flex; justify-content: center; align-items: center;">
                    <h6 class="fw-semibold mb-0">Dupe Badge Print</h6>
                </th>
                @endif
            </tr>
        </thead>
        <tbody>
            @if(!empty($attandees))
            <tr>
                <td class="border-bottom-0 display: flex; justify-content: center; align-items: center;">
                    <h6 class="fw-semibold mb-1 text-capitalize">{{$attandees['name']}}</h6>
                </td>
                <td class="border-bottom-0 display: flex; justify-content: center; align-items: center;">
                    <p class="mb-0 fw-normal mx-auto ">{{$attandees['attandeeCompany']}}</p>
                </td>
                <td class="border-bottom-0 display: flex; justify-content: center; align-items: center;">
                    <p class="mb-0 fw-normal mx-auto ">{{$attandees['attandeeCountry']}}</p>
                </td>
                <td class="border-bottom-0 display: flex; justify-content: center; align-items: center;">
                    <p class="mb-0 fw-normal mx-auto ">{{$attandees['designation']}}</p>
                </td>
                <td class="border-bottom-0 display: flex; justify-content: center; align-items: center;">
                    <p class="mb-0 fw-normal mx-auto ">{{$attandees['identity']}}</p>
                </td>
                <!-- <td class="border-bottom-0 display: flex; justify-content: center; align-items: center;">
                    <p class="mb-0 fw-normal mx-auto ">$attandees['dob']</p>
                </td> -->
                <td class="border-bottom-0 display: flex; justify-content: center; align-items: center;">
                    <p class="mb-0 fw-normal mx-auto ">{{$attandees['code']}}</p>
                </td>
                @if(session()->get('user')->roles[0]->name =="attandeeUser" ||session()->get('user')->roles[0]->name =="admin" ||session()->get('user')->roles[0]->name =="bxssUser" || session()->get('user')->roles[0]->name =="depo")
                <td class="border-bottom-0 display: flex; justify-content: center; align-items: center;">
                    <livewire:mark-attendance-component key="day_1" day="day_1" :uid="$attandees['uid']" />
                </td>
                <td class="border-bottom-0 display: flex; justify-content: center; align-items: center;">
                    <livewire:mark-attendance-component key="day_2" day="day_2" :uid="$attandees['uid']" />
                </td>
                <td class="border-bottom-0 display: flex; justify-content: center; align-items: center;">
                    <livewire:mark-attendance-component key="day_3" day="day_3" :uid="$attandees['uid']" />
                </td>
                <td class="border-bottom-0 display: flex; justify-content: center; align-items: center;">
                    <livewire:mark-attendance-component key="day_4" day="day_4" :uid="$attandees['uid']" />
                </td>
                <td class="border-bottom-0 display: flex; justify-content: center; align-items: center;">
                    <livewire:mark-attendance-component key="seminar" day="seminar" :uid="$attandees['uid']" />
                </td>
                @endif
                @if(session()->get('user')->roles[0]->name =="admin" ||session()->get('user')->roles[0]->name =="bxssUser" || session()->get('user')->roles[0]->name =="depo"|| session()->get('user')->roles[0]->name =="batchUser")
                <td class="border-bottom-0 display: flex; justify-content: center; align-items: center;">
                    <livewire:add-attandee-component :isNew='false' :visitorUid="$attandees['identity']" />
                </td>
                <td class="border-bottom-0 display: flex; justify-content: center; align-items: center;">
                    @if($attandees['badge_print'])
                    <span class="badge mx-auto  bg-success rounded-3 fw-semibold">Printed</span>
                    @else
                    <button class="btn btn-outline-primary" wire:click.prevent="redirectToBadge" style="font-size: 24px;" href="" target="_blank"><i class="ti ti-id-badge-2"></i></button>
                    @endif
                </td>
                <td class="border-bottom-0 display: flex; justify-content: center; align-items: center;">
                    @if($attandees['badge_print'])
                    <a class="btn btn-outline-warning" wire:click.prevent="redirectToBadge" style="font-size: 24px;" href="" target="_blank"><i class="ti ti-number-{{$attandees['dupe_badge_print']}}"></i></a>
                    @else
                    <span class="badge mx-auto  bg-warning rounded-3 fw-semibold">Badge Not Printed</span>
                    @endif
                </td>
                @endif
            </tr>
            @else
            <tr>
                <td colspan="12">No Data Available</td>
            </tr>
            @endif
        </tbody>
    </table>
    @if(!empty($attandees))
    @script
    <script>
        $wire.on('redirectNow', (data) => {
            window.open(`{{url('')}}/badge/badge/${data[0]['identity']}`, "_blank", "width=500,height=500");
        });
    </script>
    @endscript
    @endif
</div>