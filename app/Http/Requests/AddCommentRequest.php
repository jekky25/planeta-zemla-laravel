<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use J25\GoogleCaptcha\GoogleCaptcha;

class AddCommentRequest extends FormRequest
{
	/**
	* rules for the request
	* @return string array
	*/
	public function rules():array
	{
		return [
			'post_id'				=> ['required', 'integer', 'min:1'],
			'name'					=> ['required', 'string', 'max:30'],
			'email'					=> ['required', 'email'],
			'message'				=> ['required', 'max:1000'],
			'recaptcha_response'	=> ['required', new GoogleCaptcha]
		];
	}

	/**
	* messages for the request
	* @return string array
	*/
	public function messages():array
	{
		return  [
					'post_id'				=> 'Пост не заполнен',
					'name.required'			=> 'Поле Имя не заполнено',
					'name.max'				=> 'Поле Имя должно быть не более :max символов',
					'email.required'		=> 'Поле Емайл не заполнено',
					'email.email'			=> 'Поле Емайл заполнено не корректно',
					'message.required'		=> 'Комментарий не заполнен',
					'message.max'			=> 'Ваш комментарий слишком длинный',
					'recaptcha_response'	=> 'Капча не пройдена'
				];
	}
}
