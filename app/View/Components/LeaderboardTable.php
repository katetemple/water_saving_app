<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LeaderboardTable extends Component
{
    public $leaderboard;
    /**
     * Create a new component instance.
     */
    public function __construct($leaderboard)
    {
        $this->leaderboard = $leaderboard;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.leaderboard-table');
    }
}
