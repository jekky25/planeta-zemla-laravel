<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Response;
use Tests\TestCase;
//use App\Http\Controllers\FeedBackController;

class ValidationFormSendTest extends TestCase
{
	/**
	* Test status 200 ajax/send_mess.php 
	*/
	/*
	public function test_send_feed_back_form_valid_datas(): void
	{
		//$mock = $this->createMock(FeedBackController::class);
		$this->post('feedback/', ['name' => 'Вася', 'email' => 'jonny@list.ru', 'subject' => 'текст текст текст', 'text' => 'Текст комментария'])
        ->assertStatus(302)
		->withSession(['success']);
    }
	*/

	/**
	* Test form validation
	*/
	public function test_send_feed_back_form_no_valid_datas(): void
	{
		$response = $this->post('feedback/', [])
		->assertStatus(302)
		->assertSessionHasErrors(['name', 'email', 'subject', 'text']);

		$response = $this->post('feedback/', ['name' => 'Вася', 'email' => 'asdasdasdad'])
		->assertStatus(302)
		->assertSessionHasErrors(['subject', 'text']);

		$response = $this->post('feedback/', ['name' => 'Вася', 'email' => 'asdasdasdad', 'subject' => 'text text text text'])
		->assertStatus(302)
		->assertSessionHasErrors(['text']);
	}
}