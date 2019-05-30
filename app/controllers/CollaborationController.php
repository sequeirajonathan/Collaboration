<?php

use Phalcon\Mvc\Controller;


class CollaborationController extends Controller
{
	public function indexAction()
	{
		$id = $this->request->get('id');
		$data = Saves::find();

		if(empty($id)) {
			$selectedData = Saves::find(['order'=>'date DESC', 'limit'=>1]);
			$this->view->selectedData = $selectedData;
			$this->view->data = $data;
		} else {
			$selectedData = Saves::findFirst($id);
			$this->view->ip = $selectedData->ip;
			$this->view->date = $selectedData->date;
			$this->view->content = $selectedData->content;
			$this->view->data = $data;
		}

	}

	public function collaborateAction(){
		$addCollab = new Saves();
		$addCollab->ip = $_SERVER['REMOTE_ADDR'];
		$addCollab->content = $this->request->get('content');
		$addCollab->save();

		$this->response->redirect('collaboration');
	}
}