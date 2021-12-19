<?php

namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;
use Latte;

final class ReportPresenter extends Nette\Application\UI\Presenter
{
	private Nette\Database\Explorer $database;

	public function __construct(Nette\Database\Explorer $database)
	{
		$this->database = $database;
	}

	public function renderErrorInPost(){
		$this->template->posts = $this->database
			->table('posts');
	}
	
	protected function createComponentReportForm(): Form
	{
		$form = new Form;

		$form->addText('name', 'Jméno:')
			->setRequired();

		$form->addEmail('email', 'E-mail:')
			->setRequired();
		
		$form->addText('type', 'Předmět:')
			->setRequired();
		
		$form->addTextArea('content', 'Popis chyby:')
			->setRequired();

		$form->addSubmit('send', 'Odeslat');

		$form->onSuccess[] = [$this, 'reportFormSucceeded'];

		return $form;
	}

	public function reportFormSucceeded(\stdClass $values): void
	{
		$mail = new Nette\Mail\Message;
		$latte = new Latte\Engine;
		$params = [
			"name" => "$values->name",
			"email" => "$values->email",
			"type" => "$values->type",
			"content" => "$values->content",
		];

		$mail->setFrom('Desetiminutovka.cz <info@deset.cz>')
			->addTo('zachmart456@gmail.com')
			->setHtmlBody(
				$latte->renderToString(__DIR__ . '/templates/Report/email.latte', $params),
				__DIR__ . "../www/img/",
			);

		$mailer = new Nette\Mail\SendmailMailer;
		$mailer->send($mail);

		$this->flashMessage('Děkujeme za zpětnou vazbu.', 'success');
		$this->redirect("Homepage:default");
	}
}