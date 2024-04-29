<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;

use Validator;
use App\Helpers\Email;

class FeedbackController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		// $this->middleware('auth');
	}

	/**
	 * Show a feedBack page
     * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function getFeedBack(Request $request)
	{
		$title = 'Обратная связь, Земля как планета';
		return response()->view ('feedback', [
			'title'		=> $title
		]);
	}

	/**
	 * send a message from the feeBack page
     * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function sendFeedBack(Request $request)
	{
		$arParams = $request->post();
		$rules = [
			'name' 		=> ['required', 'string', 'max:30'],
			'email' 	=> ['required', 'email'],
			'subject'	=> ['required', 'max:300'],
			'text'	 	=> ['required', 'max:1000']
		];
		$errMessages = ['name.required' 	=> 'Поле Имя не заполнено',
						'name.max' 			=> 'Поле Имя должно быть не более :max символов',
						'email.required' 	=> 'Поле Емайл не заполнено',
						'email.email' 		=> 'Поле Емайл заполнено не корректно',
						'subject.required' 	=> 'Тема не заполнена',
						'subject.max'	 	=> 'Поле Тема должно быть не более :max символов',
						'text.required' 	=> 'Комментарий не заполнен',
						'text.max'	 	=> 'Ваш комментарий слишком длинный',
		];

		$validator = Validator::make($arParams, $rules, $errMessages);

		if ($validator->fails()) {
			return redirect('feedback')
                        ->withErrors($validator)
                        ->withInput();
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

		if ($recaptcha->success === true && $recaptcha->score >= 0.5) {
		} else {
			$strError = 'Капча не пройдена';
			return redirect('feedback')
						->withErrors($strError)
						->withInput();
		}

		$email_template = 'feedback';

		$EMAIL['NAME'] 		= $arParams['name'];
		$EMAIL['EMAIL'] 	= $arParams['email'];
		$EMAIL['SUBJECT'] 	= $arParams['subject'];
		$EMAIL['TEXT'] 		= $arParams['text'];

		Email::sendEmail($email_template, 'jekky25@list.ru', $EMAIL, 'Сообщение через обратную связь www.planeta-zemla.ru');

		if (!empty ($arParams['email_copy']) && $arParams['email_copy'] == 1)
		{
			$EMAIL['NAME'] 		= $arParams['name'];
			$EMAIL['EMAIL'] 	= $arParams['email'];
			$EMAIL['SUBJECT'] 	= $arParams['subject'];
			$EMAIL['TEXT'] 		= $arParams['text'];

			Email::sendEmail($email_template, $arParams['email'], $EMAIL, 'Сообщение через обратную связь www.planeta-zemla.ru');

		}

		return back()->with('success', 'Ваше сообщение было успешно отправлено!');
	}
}

