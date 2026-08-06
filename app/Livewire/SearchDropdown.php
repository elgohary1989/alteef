<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\Service;
use App\Models\Project;

class SearchDropdown extends Component
{
    public $q = '';

    public function render()
    {
        $services = collect();
        $posts = collect();
        $projects = collect();

        if (strlen($this->q) >= 2) {

            $services = Service::where('title_ar', 'like', "%{$this->q}%")
                ->orWhere('title_en', 'like', "%{$this->q}%")
                ->limit(5)
                ->get();

            $posts = Post::query()
                ->where('published', true)
                ->where(function ($query) {

                    $query->where('title_ar', 'like', "%{$this->q}%")
                        ->orWhere('title_en', 'like', "%{$this->q}%")
                        ->orWhere('excerpt_ar', 'like', "%{$this->q}%")
                        ->orWhere('excerpt_en', 'like', "%{$this->q}%")
                        ->orWhere('content_ar', 'like', "%{$this->q}%")
                        ->orWhere('content_en', 'like', "%{$this->q}%");

                })
                ->latest('published_at')
                ->limit(5)
                ->get();

            $projects = Project::where('title_ar', 'like', "%{$this->q}%")
                ->orWhere('title_en', 'like', "%{$this->q}%")
                ->limit(5)
                ->get();
        }

        return view('livewire.search-dropdown', [
            'services' => $services,
            'posts' => $posts,
            'projects' => $projects,
        ]);
    }
}
