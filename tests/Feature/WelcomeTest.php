<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WelcomeTest extends TestCase
{
    /** @test */
    function it_welcome_users_with_nickname()
    {
        $this->get('saludo/daniel/ruther')
            ->assertStatus(200)
            ->assertSee('Bienvenido Daniel, tu apodo es ruther');
    }

    /** @test */
    function it_welcome_users_without_nickname()
    {
        $this-> get('saludo/daniel')
            ->assertStatus(200)
            ->assertSee('Bienvenido Daniel.');
    }
}

