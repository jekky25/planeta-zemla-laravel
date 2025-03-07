<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use J25\GoogleCaptcha\GoogleCaptcha;
use Carbon\Carbon;

class AddCommentRequest extends FormRequest
{
	public static $dateFormatForDb	= 'Y-m-d H:i:s';

	/**
	* rules for the request
	* @return string array
	*/
	public function rules():array
	{
		return [
			'post_id'				=> ['required', 'integer', 'min:1'],
			'object_id'				=> ['nullable'],
			'name'					=> ['required', 'string', 'max:30'],
			'username'				=> ['string', 'max:30'],
			'email'					=> ['required', 'email'],
			'message'				=> ['required', 'max:1000'],
			'recaptcha_response'	=> ['required', new GoogleCaptcha],
			'lang'					=> ['nullable', 'string'],
			'comment'				=> ['nullable', 'string'],
			'date'					=> ['nullable'],
			'ip'					=> ['nullable', 'string'],
			'published'				=> ['nullable', 'integer']
		];
	}

	/**
	* Prepare params for validation
	*
	* @return void
	*/
	protected function prepareForValidation()
    {
        $this->merge([
			'lang'				=> 'ru-RU',
			'comment'		 	=> $this->message,
			'date'	 			=> Carbon::now()->format(self::$dateFormatForDb),
			'object_id'			=> $this->post_id,
			'name'	 			=> $this->name,
			'username'		 	=> $this->name,
			'email'		 		=> $this->email,
			'ip'	 			=> request()->ip(),
			'published'			=> 1
        ]);
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
