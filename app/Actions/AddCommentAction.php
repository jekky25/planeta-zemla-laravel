<?php

namespace App\Actions;

use App\Requests\AddCommentRequest;
use App\Models\Comment;
use Validator;

class AddCommentAction
{
	public static $dateFormatForDb	= 'Y-m-d H:i:s';

	/**
	* add comments to the DB
    * @param  App\Requests\AddCommentRequest  $request
	* @return string JSON
	*/
	public static function handle (AddCommentRequest $request)
	{
		$arParams = $request->post();
		$rules = [
			'name' 		=> ['required', 'string', 'max:30'],
			'email' 	=> ['required', 'email'],
			'comment' 	=> ['required', 'max:1000']
		];

		$errMessages = ['name.required' 	=> 'Поле Имя не заполнено',
						'name.max' 			=> 'Поле Имя должно быть не более :max символов',
						'email.required' 	=> 'Поле Емайл не заполнено',
						'email.email' 		=> 'Поле Емайл заполнено не корректно',
						'comment.required' 	=> 'Комментарий не заполнен',
						'comment.max'	 	=> 'Ваш комментарий слишком длинный',
		];

		$validator = Validator::make($arParams, $rules, $errMessages);

		if ($validator->fails()) {
			$messages = $validator->messages();
			foreach ($messages->toArray() as $n => $mess)
			{
				return showErrorMessage($mess, 'comments-form');
				break;
			}
		}

		$recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
		$recaptcha_secret = RE_SEC_KEY;
		$recaptcha_response = $arParams['recaptcha_response'];

		$ch = curl_init();
		curl_setopt_array($ch, [
			CURLOPT_URL => $recaptcha_url,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => [
			'secret' => $recaptcha_secret,
			'response' => $recaptcha_response,
			'remoteip' => $_SERVER['REMOTE_ADDR']
		   ],
		   CURLOPT_RETURNTRANSFER => true
		  ]);
	
		$output = curl_exec($ch);
		curl_close($ch);
	
		$recaptcha = json_decode($output);
		if ($recaptcha->success === true && $recaptcha->score >= 0.3) {
		} else {
			$strError = 'Капча не пройдена';
			return showErrorMessage($strError, 'comments-form');
		}

		$ip 		= request()->ip();
		$date 		= \Carbon\Carbon::parse()->format(self::$dateFormatForDb);

		$aFields = [
			'lang'				=> 'ru-RU',
			'comment'		 	=> $arParams['comment'],
			'date'	 			=> $date,
			'object_id'			=> $arParams['object_id'],
			'name'	 			=> $arParams['name'],
			'username'		 	=> $arParams['name'],
			'email'		 		=> $arParams['email'],
			'ip'	 			=> $ip,
		];


		$oComment = new Comment ($aFields);
		$oComment->save();

		$mess = 'Спасибо за комментарий. Он будет опубликован после проверки модератором';
		return showInfoMessage($mess, 'comments-form');
	}
}
