<?php

namespace Quill\SeoScore\Models;

use Illuminate\Support\Str;
use Quill\SeoScore\Events\SeoScoreCreating;
use Quill\SeoScore\Events\SeoScoreCreated;
use Quill\SeoScore\Events\SeoScoreSaving;
use Quill\SeoScore\Events\SeoScoreSaved;
use Quill\SeoScore\Events\SeoScoreUpdating;
use Quill\SeoScore\Events\SeoScoreUpdated;
use Quill\SeoScore\Models\SeoScore;

class SeoScoreObserver
{

    public function creating(SeoScore $seoscore)
    {
        // creating logic... 
        event(new SeoScoreCreating($seoscore));
    }

    public function created(SeoScore $seoscore)
    {
        // created logic...
        event(new SeoScoreCreated($seoscore));
    }

    public function saving(SeoScore $seoscore)
    {
        // saving logic...
        event(new SeoScoreSaving($seoscore));
    }

    public function saved(SeoScore $seoscore)
    {
        // saved logic...
        event(new SeoScoreSaved($seoscore));
    }

    public function updating(SeoScore $seoscore)
    {
        // updating logic...
        event(new SeoScoreUpdating($seoscore));
    }

    public function updated(SeoScore $seoscore)
    {
        // updated logic...
        event(new SeoScoreUpdated($seoscore));
    }

}