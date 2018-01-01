<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    /** @test */
    public function it_can_create_an_article()
    {
        $title = $this->faker->word;

        $data = [
            'title' => $title,
            'body' => $this->faker->paragraph,
            'user_id' => 1,
            'make_public' => 0
        ];

        $user = new User(array('name' => 'Upwork User'));
        $this->be($user);

        try {
            //Index
            $this->get("api/v1/articles")
                ->assertStatus(201);


            //Create
            $this->post("api/v1/articles", $data)
                ->assertStatus(201)
                ->assertJsonStructure(array_keys($data), $data);

            //Show, edit and setting have similar function
            $id = 1;
            $this->get("api/v1/articles", [$id] )
                ->assertStatus(201);
        }
        catch (\Exception $e)
        {
            dd($e->getMessage());
        }


    }
}
