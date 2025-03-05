<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Interfaces\PostInterface;
use App\Services\LengthPager;
use App\Models\Post;

class PostRepository implements PostInterface {

	protected $dateFormat 		= 'd.m.Y H:i';
	protected $dateFormatToRss	= 'D, d M Y H:i:s +0000';
	protected $voteClass 		= [
		'0'	 => 'vote-none',
		'1'	 => 'vote-good',
		'-1' => 'vote-poor'
		];

	/**
	* get all articles or all articles for the section
	* @param  int $count
	* @param  int $id
	* @return \Illuminate\Database\Eloquent\Collection 
	*/	
	public static function getAll(int $count, int $id)
	{
		if ((int) $id == 0) abort(404);

		$items = Post::select('*')
			->where('state', '>', '0')
			->where('sectionid', $id)
			->orderBy('ordering', 'asc')
			->paginate($count);
		return LengthPager::makeLengthAware($items, $items->total(), $count);
	}

	/**
	* get an article by id
	* @param  int $id
	* @return \Illuminate\Database\Eloquent\Collection 
	*/	
	public function getById($id)
	{
		$item = Post::select('*')
			->where('ID', $id)
			->firstOrFail();
		$this->setVoteClass($item);

		foreach ($item->comments as &$_item)
		{
			$_item 			= $this->getVoteCount($_item, $item);
			$_item->date 	= $this->getDateFormat($_item->date);
			$_item->dateStr = $this->getDateFormatToRss($_item->date);
		}
		$item->fulltext		= $this->getSapeCode($item);
		return $item;
	}

	/**
	* get articles for the main page
	* @param  int $count
	* @return \Illuminate\Database\Eloquent\Collection 
	*/		
	public static function getAllHome()
	{
		$items = Post::select('*')
			->where('state', '>', '0')
			->whereExists(function ($query) {
				$query->select(DB::raw(1))
					->from('jos1_content_frontpage')
					->whereRaw('jos1_content.id = jos1_content_frontpage.content_id');
			})
			->with('category')
			->orderBy('ordering', 'asc')
			->get();

		return $items;
	}

	/**
	* set vote class
	* @param  \App\Models\Post $item
	* @return void
	*/	
	public function setVoteClass(&$item)
	{
		$item->voteClass = $this->voteClass;
	}

	/**
	* get vote class
	* @return array
	*/
	public function getVoteClass()
	{
		return $this->voteClass;
	}

	/**
	* get formate date
	* @param  string $date
	* @return string
	*/
	public function getDateFormat($date)
	{
		return \Carbon\Carbon::parse($date)->format($this->dateFormat);
	}

	/**
	* get formate date to Rss
	* @param  string $date
	* @return string
	*/
	public function getDateFormatToRss($date)
	{
		return \Carbon\Carbon::create($date)->format($this->dateFormatToRss);
	}

	/**
	* replace text to the text with a sape code
	* @param  \App\Models\Post $post
	* @return string
	*/
	public function getSapeCode($post)
	{
		return \App\Providers\SapeServiceProvider::replaceSapeCode($post->fulltext);
	}
	
	/**
	* get count of the votes for the comment
	* @param  \App\Models\Comment $_item
	* @param  \App\Models\Post $item
	* @return \App\Models\Post 
	*/	
	public static function getVoteCount($_item, $item)
	{
		$_item->voteClass = $item->voteClass[0];
		if ($_item['isgood'] > $_item['ispoor']) $_item->voteClass = $item->voteClass[1];
		if ($_item['isgood'] < $_item['ispoor']) $_item->voteClass = $item->voteClass[-1];
		$_item['voteCount'] =  $_item['isgood'] - $_item['ispoor'];
		return ($_item);
	}
}