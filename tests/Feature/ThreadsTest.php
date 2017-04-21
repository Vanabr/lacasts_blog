<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ThreadsTest extends TestCase
{
    use DatabaseMigrations;
    /**test **/
    public function test_a_user_can_browse_all_threads()
    {
        $thread = factory('App\Thread')->create();
        $response = $this->get('/threads');

        $response->assertSee($thread->title);
    }

    public function test_a_user_can_browse_single_thread()
    {
        $thread = factory('App\Thread')->create();

        $response = $this->get('/threads/'.$thread->id);
        $response->assertSee($thread->title);
    }
}
