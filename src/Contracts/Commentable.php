<?php

namespace Fawad\Comments\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface Commentable
{
    /**
     * Get all comments for the model.
     */
    public function comments(): MorphMany;
}
