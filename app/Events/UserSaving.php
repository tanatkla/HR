<?php

namespace App\Events;

use App\Models\User as ModelsUser;
use App\User;
use Illuminate\Queue\SerializesModels;

class UserSaving
{
    use SerializesModels;

    public $user;

    /**
     * Create a new event instance.
     *
     * @param \App\User $user
     */
    public function __construct(ModelsUser $user)
    {
        $this->user = $user;
    }
}