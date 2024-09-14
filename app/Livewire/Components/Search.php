<?php

namespace App\Livewire\Components;

use App\Models\Product;
use Livewire\Component;

class Search extends Component
{

    public $search_results = [];
    public $keyword;

    public function render()
    {

        $this->load();

        return view('livewire.components.search');
    }

    public function load()
    {

        if ($this->keyword) {
            // dd($this->keyword);
            $this->search_results = Product::where("name", "LIKE", '%' . $this->keyword . '%')->orWhere("brand", "LIKE", '%' . $this->keyword . '%')->orWhere("description", "LIKE", '%' . $this->keyword . '%')->orderBy("created_at", "DESC")->get();
        }
    }
}
