<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use J25\GoogleCaptcha\GoogleCaptcha;

class FeedBackRequest extends FormRequest
{
	/**
	* rules for the request
	* @return string array
	*/
	public function rules():array
	{
		return [
			'name'					=> ['required', 'string', 'max:30'],
			'email'					=> ['required', 'email'],
			'subject'				=> ['required', 'max:300'],
			'message'				=> ['required', 'max:1000'],
			'recaptcha_response'	=> ['required', new GoogleCaptcha],
			'copy'					=> ['bool']
		];
	}

	/**
	* messages for the request
	* @return string array
	*/
	public function messages():array
	{
		return	[
					'name.required'					=> 'Поле Имя не заполнено',
					'name.max'						=> 'Поле Имя должно быть не более :max символов',
					'email.required'				=> 'Поле Емайл не заполнено',
					'email.email'					=> 'Поле Емайл заполнено не корректно',
					'subject.required'				=> 'Тема не заполнена',
					'subject.max'					=> 'Поле Тема должно быть не более :max символов',
					'message.required'				=> 'Комментарий не заполнен',
					'message.max'					=> 'Ваш комментарий слишком длинный',
					'recaptcha_response' 			=> 'Капча не пройдена'
				];
	}

	/**
	* Get the validated data from the request.
	*
	* @param  array|int|string|null  $key
	* @param  mixed  $default
	* @return mixed
	*/
	public function validated($key = null, $default = null)
	{
		$ar = $this->validator->validated();
		$ar['copy'] = !empty ($ar['copy']) ?: 0;
		return data_get($ar, $key, $default);
	}
}