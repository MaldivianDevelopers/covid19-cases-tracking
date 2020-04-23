<?php

namespace App\Http\Livewire;

use Illuminate\Support\Collection;
use Livewire\Component;

class CasesListingTable extends Component
{

    protected $cases;

    public function mount(Collection $cases)
    {
        $this->cases = $cases;
    }



    public function render()
    {
        return view('livewire.cases-listing-table', [
            'cases' => $this->cases
        ]);
    }
}
