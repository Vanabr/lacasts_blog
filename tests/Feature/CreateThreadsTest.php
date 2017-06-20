<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreateThreadsTest extends TestCase
{
    use DatabaseMigrations;

    public function test_an_authenticated_user_can_create_new_forum_threads()
    {
        //У нас есть авторизованый пользователь
       // $this->actingAs(create('App\User'));
        $this->signIn();
        $thread = make('App\Thread');

        $this->post('/threads', $thread->toArray());

        $this->get($thread->path())
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }

    public function test_an_unauthenticated_user_may_not_create_a_thread()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $thread = make('App\Thread');

        $this->post('/threads', $thread->toArray());
    }
}
