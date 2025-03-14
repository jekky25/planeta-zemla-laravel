<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeedBackRequest;
use App\Helpers\Email;
use Inertia\Inertia;

class FeedbackController extends Controller
{
	/**
	* Show a feedBack page
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function get()
    {
		$title = 'Обратная связь, Земля как планета';
		return Inertia::render('FeedBack', ['title'		=> $title]);
	}

	/**
	* send a message from the feeBack page
	* @param FeedBackRequest $request
	* @return \Illuminate\Http\Response
	*/
	public function send(FeedBackRequest $request)
	{
		$arParams	= $request->validated();
		$email_template = 'feedback';
		$EMAIL['NAME']		= $arParams['name'];
		$EMAIL['EMAIL']		= $arParams['email'];
		$EMAIL['SUBJECT']	= $arParams['subject'];
		$EMAIL['TEXT']		= $arParams['message'];

		Email::sendEmail($email_template, 'jekky25@list.ru', $EMAIL, 'Сообщение через обратную связь www.planeta-zemla.ru');
		if (Email::isSendCopy($arParams['email_copy']))
		{
			Email::sendEmail($email_template, $arParams['email'], $EMAIL, 'Сообщение через обратную связь www.planeta-zemla.ru');
		}
		return response()->json(['success' => 1]);
	}
}
