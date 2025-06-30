<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Lazy;
use Illuminate\Support\Str;
use App\Models\Visitors;

#[Lazy]
class SelfRegistrationComponent extends Component
{

    protected $listeners = [
        'refreshingSelfRegComponent' => '$refresh'
    ];

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


    public function addNew()
    {

        $validatedData = $this->validate();
        try {
            $visitorCreated = Visitors::create([
                ...$validatedData,
                'uid' => (string) Str::uuid(),
                'code' => $this->badge(6, 'TVFA'),
            ]);

            if ($visitorCreated) {
                // $visitors = Visitors::where('identity', $validatedData['identity'])->first();
                session()->flash('message', 'Visitor has been updated successfully!');
                $this->reset();
                $this->dispatch('slipPrint', $validatedData['identity'])->self();
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
        $this->dispatch('refreshingSelfRegComponent');
    }


    public function render()
    {
        return view('livewire.self-registration-component');
    }
}
