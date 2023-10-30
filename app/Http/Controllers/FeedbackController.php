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
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getFeedBack(Request $request)
	{
		$title = 'Обратная связь, Земля как планета';
		return response()->view ('feedback', [
			'title'		=> $title
		]);
	}

	public function sendFeedBack(Request $request)
	{
		$arParams = $request->post();
		$rules = [
			'name' 		=> ['required', 'string', 'max:30'],
			'email' 	=> ['required', 'email'],
			'subject'	=> ['required', 'max:300'],
			'comment' 	=> ['required', 'max:1000']
		];
		$errMessages = ['name.required' 	=> 'Поле Имя не заполнено',
						'name.max' 			=> 'Поле Имя должно быть не более :max символов',
						'email.required' 	=> 'Поле Емайл не заполнено',
						'email.email' 		=> 'Поле Емайл заполнено не корректно',
						'subject.required' 	=> 'Тема не заполнена',
						'subject.max'	 	=> 'Поле Тема должно быть не более :max символов',
						'comment.required' 	=> 'Комментарий не заполнен',
						'comment.max'	 	=> 'Ваш комментарий слишком длинный',
		];

		$validator = Validator::make($arParams, $rules, $errMessages);

		if ($validator->fails()) {
			return redirect('feedback')
                        ->withErrors($validator)
                        ->withInput();
		}

	}
}

