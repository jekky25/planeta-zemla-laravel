<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class AddCommentRequest extends FormRequest
{
	/**
	* rules for the request
	* @return string array
	*/
	public function rules():array
	{
		return [
            'name' 		=> ['required', 'string', 'max:30'],
			'email' 	=> ['required', 'email'],
			'comment' 	=> ['required', 'max:1000']
        ];
	}

	/**
	* messages for the request
	* @return string array
	*/
	public function messages():array
	{
		return  [
					'name.required' 	=> 'Поле Имя не заполнено',
					'name.max' 			=> 'Поле Имя должно быть не более :max символов',
					'email.required' 	=> 'Поле Емайл не заполнено',
					'email.email' 		=> 'Поле Емайл заполнено не корректно',
					'comment.required' 	=> 'Комментарий не заполнен',
					'comment.max'	 	=> 'Ваш комментарий слишком длинный',
				];
	}
}
