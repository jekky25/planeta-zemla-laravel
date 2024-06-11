<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Interfaces\PostInterface;

use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Vote;

use Validator;

class ItemController extends Controller
{
	public 	$dateFormatToRss 	= 'D, d M Y H:i:s +0000';
	public 	$dateFormatForDb	= 'Y-m-d H:i:s';
	
     /**
     * Create a new controller instance.
     *
     * @return void
     */
	public function __construct(protected PostInterface $postRepository
	)
	{
	}

    /**
	 * Show an article page
     * @param  \Illuminate\Http\Request  $request
	 * @param string $name
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function getItem(Request $request, $name, $id)
	{
		$post 			= $this->postRepository->getById($id);
		$post->fulltext = $this->postRepository->getSapeCode($post);
		if (empty ($post)) abort(404);

		$data = [
			'title'			=> $post->title . ' Земля как планета',
			'post'			=> $post
		];
		return response()->view('post', $data);
	}

	/**
	 * Show rss on the page
     * @param  \Illuminate\Http\Request  $request
	 * @param string $name
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function getRss(Request $request, $name, $id)
	{
		$post 	= $this->postRepository->getById($id);
		if (empty ($post)) abort(404);
		$data = [
			'post'			=> $post,
			'refreshTime'	=> $this->postRepository->getDateFormatToRss(\Carbon\Carbon::now())
		];

		return response()
		->view ('post.rss', $data)
		->header('Content-Type', 'application/xml');
	}

	/**
	 * get ajax requests
     * @param  \Illuminate\Http\Request  $request
	 * @return string JSON
	 */
	public function getAjax(Request $request)
	{
		$arParams = $request->post();
		if (empty ($arParams['jtxf'])) abort(404);
		$act = $arParams['jtxf'];
		switch ($act) {
			case 'JCommentsShowPage':
				$x = self::getComments($request);
				break;
			
			case 'JCommentsVoteComment':
				$x = self::setVoteComment($request);
				break;

			case 'JCommentsAddComment':
				$x = self::addComment($request);
				break;
			default:
			abort(404);
		}

		return $x;
	}

	/**
	 * show commments over ajax on the web page
     * @param  \Illuminate\Http\Request  $request
	 * @return string JSON
	 */
	public function getComments(Request $request)
	{
		$arParams = $request->post();
		if (empty ($arParams['jtxa'][0])) abort(404);
		$id = (int) $arParams['jtxa'][0];
		if ($id == 0) abort(404);

		$post   = Post::getById($id);
		$str = '
		<h4>Комментарии
			<a class="rss" href="' . route('comment_rss',[$post->category['alias'], $post->id,$post->alias]) . '" title="RSS лента комментариев этой записи" target="_blank">&nbsp;</a>
			<a class="refresh" href="#" title="Обновить список комментариев" onclick="jcomments.showPage(' . $post->id . ',`com_content`,0);return false;">&nbsp;</a>
		</h4>
		<div id="comments-list" class="comments-list">
		';

		$iteration = 0;		
		foreach ($post->comments as $item)
		{
			$iteration++;
			$str .= '<div class="even" id="comment-item-' . $item->id . '">
			<div class="rbox">
				<div class="rbox_tr">
					<div class="rbox_tl">
						<div class="rbox_t">&nbsp;</div>
					</div>
				</div>
				<div class="rbox_m">
					<div class="comment-box usertype-guest">
						<span class="comments-vote">
							<span id="comment-vote-holder-' . $item->id . '">
								<a href="#" class="vote-good" title="Хороший комментарий!" onclick="jcomments.voteComment(' . $item->id . ', 1);return false;"></a>
								<a href="#" class="vote-poor" title="Плохой комментарий!" onclick="jcomments.voteComment(' . $item->id . ', -1);return false;"></a>
								<span class="' . $item->voteClass . '">' . $item->voteCount . '</span>
							</span>
						</span>
						<a class="comment-anchor" href="' . route('item_name',[$post->category['alias'], $post->id,$post->alias]) . '#comment-' . $item->id . '" id="comment-' . $item->id . '">#' . $iteration . '</a>
						<span class="comment-author">' . $item->name . '</span>
						<span class="comment-date">' . $item->date . '</span>
						<div class="comment-body" id="comment-body-' . $item->id . '">' . $item->comment . '</div>
						<span class="comments-buttons">
							<a href="#" onclick="jcomments.quoteComment(' . $item->id . '); return false;">Цитировать</a>
						</span>
					</div>
					<div class="clear"></div>
				</div>
				<div class="rbox_br">
					<div class="rbox_bl">
						<div class="rbox_b">&nbsp;</div>
					</div>
				</div>
			</div>
		</div>';
		}
		
		$str .= '</div>';
		$str .= '<div id="comments-list-footer">
			<a class="refresh" href="#" title="Обновить список комментариев" onclick="jcomments.showPage(' . $post->id . ',`com_content`,0);return false;">Обновить список комментариев</a>
			<br />
			<a class="rss" href="' . route('comment_rss',[$post->category['alias'], $post->id,$post->alias]) . '" target="_blank">RSS лента комментариев этой записи</a>
		</div>';

		$str = str_replace(["\r", "\n"], '', $str);

		$y = "jcomments.updateList('" . $str . "','r');";

		$x = '[ { "n": "js", "d": "' . $y . '" } ]';

		$arX = [
			"n" => "js",
			"d" => $y

		];

		$x = '[ ' . json_encode ($arX) . ' ]';

		return $x;
	}

	/**
	 * add comments to the DB
     * @param  \Illuminate\Http\Request  $request
	 * @return string JSON
	 */
	public function addComment(Request $request)
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
		$date 		= \Carbon\Carbon::parse()->format($this->dateFormatForDb);

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

	/**
	 * add vote to the DB and show it on the page
     * @param  \Illuminate\Http\Request  $request
	 * @return string JSON
	 */
	public function setVoteComment(Request $request)
	{
		$arParams = $request->post();
		if (empty ($arParams['jtxa'][0])) abort(404);
		
		$id 	= (int) $arParams['jtxa'][0];
		$vote 	= $arParams['jtxa'][1];
		if ($id == 0 || empty ($vote)) abort(404);

		$vote	= $vote == 1 ? $vote : '-1';

		$comment = Comment::getById($id);
		if (count ($comment->votes) > 0) abort(404);

		$ip = request()->ip();
		$date 		= \Carbon\Carbon::parse()->format($this->dateFormatForDb);

		$aFields = [
			'commentid' => $id,
			'userid' 	=> 0,
			'ip'	 	=> $ip,
			'date'	 	=> $date,
			'value' 	=> $vote
		];

		$oVote = new Vote ($aFields);
		$oVote->save();

		if ($vote == '1')
			$comment->isgood = $comment->isgood + 1;
		else
			$comment->ispoor = $comment->ispoor + 1;

		$comment->save();

		$oPost 		= new Post();
		$voteClass 	= $oPost->getVoteClass();
		
		$comment->voteClassOut = $voteClass[0];
		if ($comment['isgood'] > $comment['ispoor']) $comment->voteClassOut = $voteClass[1];
		if ($comment['isgood'] < $comment['ispoor']) $comment->voteClassOut = $voteClass[-1];
		$comment['voteCount'] =  $comment['isgood'] - $comment['ispoor'];


		$str = '<span class="' . $comment->voteClassOut . '">' . $comment->voteCount . '</span>';
		$str = str_replace(["\r", "\n"], '', $str);

		$y = "jcomments.updateVote('" . $id . "','" . $str . "');";

		$arX = [
			"n" => "js",
			"d" => $y
		];
		$x = '[ ' . json_encode ($arX) . ' ]';

		return $x;
	}
}
