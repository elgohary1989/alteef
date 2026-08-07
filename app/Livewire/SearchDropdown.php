<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Service;
use App\Models\Product;
use App\Models\Project;

class SearchDropdown extends Component
{
    public $q = '';

    public function render()
    {
        $services = collect();
        $products = collect();
        $projects = collect();

        if (strlen($this->q) >= 2) {

            $services = Service::query()
                ->where(function ($query) {
                    $query->where('title_ar', 'like', "%{$this->q}%")
                        ->orWhere('title_en', 'like', "%{$this->q}%");
                })
                ->limit(5)
                ->get();

            $products = Product::query()
                ->where('is_active', 1)
                ->where(function ($query) {
                    $query->where('name_ar', 'like', "%{$this->q}%")
                        ->orWhere('name_en', 'like', "%{$this->q}%")
                        ->orWhere('description_ar', 'like', "%{$this->q}%")
                        ->orWhere('description_en', 'like', "%{$this->q}%");
                })
                ->latest()
                ->limit(5)
                ->get();

            $projects = Project::query()
                ->where(function ($query) {
                    $query->where('title_ar', 'like', "%{$this->q}%")
                        ->orWhere('title_en', 'like', "%{$this->q}%");
                })
                ->limit(5)
                ->get();
        }

        return view('livewire.search-dropdown', [
            'services' => $services,
            'products' => $products,
            'projects' => $projects,
        ]);
    }
}
