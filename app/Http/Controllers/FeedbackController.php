<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Requests\FeedBackRequest;
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
	}

	/**
	* Show a feedBack page
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function getFeedBack()
	{
		$title = 'Обратная связь, Земля как планета';
		return response()->view ('feedback', [
			'title'		=> $title
		]);
	}

	/**
	* send a message from the feeBack page
	* @param FeedBackRequest $request
	* @return \Illuminate\Http\Response
	*/
	public function sendFeedBack(FeedBackRequest $request)
	{
		$arParams	= $request->post();
		$email_template = 'feedback';

		$EMAIL['NAME'] 		= $arParams['name'];
		$EMAIL['EMAIL'] 	= $arParams['email'];
		$EMAIL['SUBJECT'] 	= $arParams['subject'];
		$EMAIL['TEXT'] 		= $arParams['text'];

		Email::sendEmail($email_template, 'jekky25@list.ru', $EMAIL, 'Сообщение через обратную связь www.planeta-zemla.ru');

		if (!empty ($arParams['email_copy']) && $arParams['email_copy'] == 1)
		{
			Email::sendEmail($email_template, $arParams['email'], $EMAIL, 'Сообщение через обратную связь www.planeta-zemla.ru');
		}

		return back()->with('success', 'Ваше сообщение было успешно отправлено!');
	}
}