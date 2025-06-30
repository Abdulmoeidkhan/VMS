<?php

namespace App\Livewire;

use App\Models\Country;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Lazy;

#[Lazy]
class EssentialModalFormComponent extends Component
{


    public $name = '';
    public $field1 = '';
    public $field2 = '';
    public $className = '';
    public $colorClass = '';
    public $btnName = '';
    public $modalId = '';

    public function mount($modalId, $name, $className, $colorClass, $btnName)
    {
        $this->modalId = $modalId;
        $this->name = $name;
        $this->className = $className;
        $this->$colorClass = $colorClass;
        $this->$btnName = $btnName;
    }


    public function placeholder()
    {
        return <<<'HTML'
                <div class="mb-3">
                    <div class="row">
                        <div class="col-md-12">
                        <div class="mb-3">
                            <button type="button" class="btn btn-outline-{{$colorClass}}">{{$btnName}}</button>
                        </div>
                        </div>
                    </div>  
                </div>
        HTML;
    }


    public function save()
    {
        $field = new $this->className;
        $field->name = $this->field1;
        $field->display_name = $this->field2;
        $fieldSaved = $field->save();
        if ($fieldSaved) {
            $this->js("alert('Updated!')");
            $this->dispatch('essential-updated')->self();
            $this->pull(['field1', 'field2']);
        } else {
            $this->js("alert('SomeThing Went Wrong!')");
        }
    }


    #[On('essential-updated')]
    public function render()
    {
        return view('livewire.essential-modal-form-component');
    }
}
