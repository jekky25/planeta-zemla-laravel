<?php

namespace App\Actions;

use App\Requests\AddCommentRequest;
use App\Services\JsonService;
use App\Services\GoogleCaptchaService;
use App\Repositories\CommentRepository;
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
		$arParams = $request->all();
		$validator = Validator::make($arParams, $request->rules(), $request->messages());

		if ($validator->fails()) {
			$messages = $validator->messages();
			foreach ($messages->toArray() as $n => $mess)
			{
				return JsonService::showErrorMessage($mess, 'comments-form');
				break;
			}
		}

		$captcha 	= new GoogleCaptchaService($arParams['recaptcha_response']);
		$captcha->check();

		if ($captcha->hasError())
		{
			return JsonService::showErrorMessage($captcha->getErrorMessage(), 'comments-form');
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
		try {
			$commentRepository = new CommentRepository();
			$commentRepository->create($aFields);

			$mess = 'Спасибо за комментарий. Он будет опубликован после проверки модератором';
			return JsonService::showInfoMessage($mess, 'comments-form');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
	}
}
