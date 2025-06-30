<?php

namespace App\Livewire;

use App\Models\Visitors;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Lazy;
// use Carbon\Carbon;
// use Illuminate\Support\Facades\Http;


#[Lazy]
class AttandeeListComponent extends Component
{
    // For Searches
    public $attandees = [];
    public $badgeData = [];


    #[On('userUpdate')]
    public function handleEvent($data)
    {
        // if (!empty($data) && !empty($data['dob']) ? $data['dob'] : false) {
        //     $carbonDate = Carbon::parse($data['dob']);
        //     $data['dob'] = $carbonDate->format('Y-m-d');
        // }
        $this->attandees = $data ? $data : [];
        $this->badgeData = $this->attandees ? Visitors::where('uid', $this->attandees['uid'])->first() : [];
        if ($this->badgeData) {
            $this->dispatch('dataupdate')->self();
        }
    }

    #[On('dataupdate')]
    public function redirectToBadge()
    {
        $badgePrinted = $this->badgeData['badge_print'];
        if (!$badgePrinted) {
            Visitors::where('code', $this->attandees['code'])->update(['badge_print' => 1]);
            $this->attandees = Visitors::where('uid', $this->attandees['uid'])->first();
            $this->dispatch('dataupdate')->self();
            $this->dispatch('redirectNow', $this->attandees)->self();
            // return redirect()->to('https://www.example.com')->with('target', '_blank');
        } else {
            Visitors::where('code', $this->attandees['code'])->update(['dupe_badge_print' => $this->badgeData['dupe_badge_print'] + 1]);
            $this->attandees = Visitors::where('uid', $this->attandees['uid'])->first();
            $this->dispatch('dataupdate')->self();
            $this->dispatch('redirectNow', $this->attandees)->self();
        }
    }


    #[On('dataupdate')]
    public function render()
    {
        return view('livewire.attandee-list-component');
    }
}
