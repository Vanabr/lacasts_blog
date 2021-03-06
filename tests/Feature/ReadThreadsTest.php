<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ReadThreadsTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
       parent::setUp();

       $this->thread = create('App\Thread');
    }


    /**test **/
    public function test_a_user_can_browse_all_threads()
    {
        $response = $this->get('/threads');
        $response->assertSee($this->thread->title);
    }

    public function test_a_user_can_browse_single_thread()
    {
        $response = $this->get('/threads/'.$this->thread->id);
        $response->assertSee($this->thread->title);
    }

    public function test_a_user_can_read_replies_that_a_associated_with_thread()
    {
        $reply = create('App\Reply', ['thread_id' => $this->thread->id]);

        $this->get('/threads/'.$this->thread->id)
            ->assertSee($reply->body);
    }

    public function test_a_user_can_see_thread_creator_name()
    {
        $response = $this->get('/threads/'.$this->thread->id);
        $response->assertSee($this->thread->creator->name);
    }
}
