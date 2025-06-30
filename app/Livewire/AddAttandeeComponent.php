<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Lazy;
use Illuminate\Support\Str;
use App\Models\Visitors;
use Livewire\Attributes\On;
// use Carbon\Carbon;
// use DateTime;

#[Lazy]
class AddAttandeeComponent extends Component
{

    protected $listeners = [
        'refreshingComponent' => '$refresh'
    ];

    // For Modal 
    public $isOpen = false;
    public $isNew = true;
    public $visitorUid = '';

    // For Adding New Visitor
    #[Validate('required|min:3')]
    public $name = '';

    #[Validate('required|min:3')]
    public $attandeeCompany = '';

    #[Validate('required|min:3')]
    public $attandeeCountry = '';

    #[Validate('required|min:3')]
    public $designation = '';

    #[Validate('required|min:9')]
    public $identity = '';

    #[Validate('numeric|min:9')]
    public $contact = '';

    #[Validate('email')]
    public $email = '';

    // For date validity
    public $maxDate;

    public function toggleModal()
    {
        $this->isOpen = !$this->isOpen;
        if ($this->isOpen && $this->isNew) {
            $this->name = '';
            $this->attandeeCompany = '';
            $this->designation = '';
            $this->attandeeCountry = '';
            $this->identity = '';
            $this->contact = '';
            $this->email = '';
        } elseif ($this->isOpen && $this->isNew && $this->visitorUid) {
            $visitor = Visitors::where('identity', $this->visitorUid)->first();
            $this->name = $visitor->name;
            $this->attandeeCompany = $visitor->attandeeCompany;
            $this->designation = $visitor->designation;
            $this->attandeeCountry = $visitor->attandeeCountry;
            $this->identity = $visitor->identity;
            $this->contact = $visitor->contact;
            $this->email = $visitor->email;
        }
    }

    // Badge code function
    protected function badge($characters, $prefix)
    {
        $possible = '0123456789';
        $code = $prefix;
        $i = 0;
        while ($i < $characters) {
            $code .= substr($possible, mt_rand(0, strlen($possible) - 1), 1);
            if ($i < $characters - 1) {
                $code .= "";
            }
            $i++;
        }
        return $code;
    }


    public function mount($isNew)
    {
        // Calculate the date 18 years ago
        // $this->maxDate = Carbon::now()->subYears(18)->toDateString();
        $this->isNew = $isNew;
        if (!$this->isNew) {
            $visitor = Visitors::where('identity', $this->visitorUid)->first();
            // $carbonDate=Carbon::parse($visitor->dob);
            // $this->dob=$carbonDate->format('Y-m-d');
            $this->name = $visitor->name;
            $this->attandeeCompany = $visitor->attandeeCompany;
            $this->designation = $visitor->designation;
            $this->attandeeCountry = $visitor->attandeeCountry;
            $this->identity = $visitor->identity;
            $this->contact = $visitor->contact;
            $this->email = $visitor->email;
        }
    }

    #[On('searchAttandeeUpdate')]
    public function handleEvent($data)
    {
        $visitor = Visitors::where('uid', $data)->first();
        // $carbonDate=Carbon::parse($visitor->dob);
        // $this->dob=$carbonDate->format('Y-m-d');
        $this->name = $visitor?$visitor->name:'';
        $this->attandeeCompany = $visitor?$visitor->attandeeCompany:'';
        $this->designation = $visitor?$visitor->designation:'';
        $this->attandeeCountry = $visitor?$visitor->attandeeCountry:'';
        $this->identity = $visitor?$visitor->identity:'';
        $this->contact = $visitor?$visitor->contact:'';
        $this->email = $visitor?$visitor->email:'';
    }


    public function update()
    {

        $validatedData = $this->validate();
        // return $validatedData;
        try {
            // $visitorCreated = Visitors::create([
            //     ...$validatedData,
            //     'uid' => (string) Str::uuid(),
            //     'code' => $this->badge(6, 'TVFA'),
            // ]);

            $visitorUpdated = Visitors::where('identity', $this->visitorUid)->update($validatedData);

            if ($visitorUpdated) {
                $visitors = Visitors::where('identity', $validatedData['identity'])->first();
                session()->flash('message', 'Visitor has been updated successfully!');
                $this->dispatch('userUpdate', $visitors)->to(AttandeeListComponent::class);
                // $this->maxDate = Carbon::now()->subYears(18)->toDateString();
            } else {
                session()->flash('error', 'Visitor not updated, SomeThing Went Wrong!');
            }
        } catch (\Illuminate\Database\QueryException $e) {
            // If an exception is caught, flash an error
            if ($e->errorInfo[1] == 1062) {
                // Duplicate entry error
                session()->flash('error', 'The identity number is already in use. Please provide a unique identity.');
            } else {
                // General error
                session()->flash('error', 'Something went wrong. Please try again.');
            }
        }
        $this->dispatch('refreshingComponent');
    }

    // For Adding New Visitor
    public function addNew()
    {

        $validatedData = $this->validate();
        // return $validatedData;
        try {
            $visitorCreated = Visitors::create([
                ...$validatedData,
                'uid' => (string) Str::uuid(),
                'code' => $this->badge(6, 'TVFA'),
            ]);

            if ($visitorCreated) {
                $visitors = Visitors::where('identity', $validatedData['identity'])->first();
                session()->flash('message', 'Visitor has been updated successfully!');
                $this->reset();
                $this->dispatch('userUpdate', $visitors)->to(AttandeeListComponent::class);
                // $this->maxDate = Carbon::now()->subYears(18)->toDateString();
            } else {
                session()->flash('error', 'Visitor not updated, SomeThing Went Wrong!');
            }
        } catch (\Illuminate\Database\QueryException $e) {
            // If an exception is caught, flash an error
            if ($e->errorInfo[1] == 1062) {
                // Duplicate entry error
                session()->flash('error', 'The identity number is already in use. Please provide a unique identity.');
            } else {
                // General error
                session()->flash('error', 'Something went wrong. Please try again.');
            }
        }
        $this->dispatch('refreshingComponent');
    }


    public function render()
    {
        return view('livewire.add-attandee-component');
    }
}
