<?php
class Record extends WebLoginBase{
	public $pageSize=20;
	
	public final function search(){
		
		$this->getTypes();
		$this->getPlayeds();
		$this->action='searchGameRecord';
		$this->display('record/search.php');
	}

	public final function searchGameRecord(){
		$this->getTypes();
		$this->getPlayeds();
		$this->display('record/search-list.php');
	}
	
	public final function betInfo($id){
		$this->getTypes();
		$this->getPlayeds();
		$this->display('record/bet-info.php', 0 , $id);
	}
	
	public final function betInfo2($id){
		$this->getTypes();
		$this->getPlayeds();
		$this->display('record/bet-info-2.php', 0 , $id);
	}
}
