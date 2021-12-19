<?php

namespace App\Presenters;

use Nette;
use Nette\Utils\DateTime;

final class PrispevekPresenter extends Nette\Application\UI\Presenter
{
	private Nette\Database\Explorer $database;

	public function __construct(Nette\Database\Explorer $database)
	{
		$this->database = $database;
	}

	public function renderSingle(int $postId): void
	{
		$post = $this->database
			->table('posts')
			->get($postId);

		if(!$post){
			$this->error("ahoj");
		}

		$this->template->post = $post;
	}

	public function renderAll(): void
    {
		$this->template->posts = $this->database
			->table('posts')
			->where( 'dateTest', date('Y-m-d'))
			->order('date DESC')
			->limit(30);
	}
}