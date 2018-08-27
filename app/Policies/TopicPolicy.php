<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Topic;

class TopicPolicy extends Policy
{
    public function update(User $user, Topic $topic)
    {
        // return $topic->user_id == $user->id;
        return true;
    }

    public function destroy(User $user, Topic $topic)
    {
        return true;
    }

    // public function saving(Topic $topic)
    // {
    //     $topic->excerpt = make_excerpt($topic->body);
    // }

    public function saving(Topic $topic)
    {
        $topic->excerpt = make_excerpt($topic->body);

    }
}
