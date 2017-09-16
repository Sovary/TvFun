<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use Post;

class ViewPostHandler extends Event
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }

    public function handle(Post $post)
    {
        // Increment the view counter by one...
        $post->increment('view_count');

        // Then increment the value on the model so that we can
        // display it. This is because the increment method
        // doesn't increment the value on the model.
        $post->view_count += 1; 
    }
}
