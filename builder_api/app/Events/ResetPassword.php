<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Queue\SerializesModels;

class ResetPassword
{
    use SerializesModels;

    /**
     * @var Authenticatable
     * @var string
     */
    public Authenticatable $user;
    public string $callbackContactUrl;

    /**
     * Create a new event instance.
     *
     * @param User $user
     * @param string $callbackContactUrl
     */
    public function __construct(User $user, string $callbackContactUrl)
    {
        $this->user = $user;
        $this->callbackContactUrl = $callbackContactUrl;
    }
}