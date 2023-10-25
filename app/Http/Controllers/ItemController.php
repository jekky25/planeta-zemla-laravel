<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;

use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Vote;

class ItemController extends Controller
{
	public 	$dateFormat 		= 'd.m.Y H:i';
	public 	$dateFormatToRss 	= 'D, d M Y H:i:s +0000';
	public 	$dateFormatForDb	= 'Y-m-d H:i:s';
	
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
	public function getItem(Request $request, $name, $id)
	{
		$post   = Post::getById($id);
		if (empty ($post)) abort(404);

		$title = $post->title . ' Земля как планета';
	
		if (!empty ($post->comments))
		{
			foreach ($post->comments as &$item)
			{
				$date 		= \Carbon\Carbon::parse($item->date)->format($this->dateFormat);
				$item->date = $date;
			}
		}

		return view('post')
		->with(compact('title'))
        ->with(compact('post'));
	}

	public function getRss(Request $request, $name, $id)
	{
		$post   = Post::getById($id);

		if (empty ($post)) abort(404);

		$startStr = '<?xml version="1.0" encoding="utf-8"?>';

		$mTime = \Carbon\Carbon::now();
		$refreshTime = $mTime->format($this->dateFormatToRss);

		foreach ($post->comments as &$item)
		{
			$mTime = \Carbon\Carbon::create($item->date);
			$postTime = $mTime->format($this->dateFormatToRss);

			$item->dateStr = $postTime;
		}

		return response()
		->view ('post.rss', [
			'startStr'		=> $startStr,
			'post'			=> $post,
			'refreshTime'	=> $refreshTime
		])
		->header('Content-Type', 'application/xml');
	}

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
			default:
			abort(404);
		}

		return $x;
	}

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

		$vote = new Vote ($aFields);
		$vote->save();

	}
}
