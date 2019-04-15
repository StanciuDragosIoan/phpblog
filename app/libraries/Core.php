 <?php

 //APP Core class (creates url and loads core controller)
 //URL FORMAT:   /controller/method/params

 class Core{
	//define protected properties and set them to values
	protected $currentController = 'Pages';   //default controller 
	protected $currentMethod = 'index';        //default method
	protected $params = [];

	//define a constructor which will get the url (will call the getUrl() function)
	 public function __construct(){
    		$this->getUrl();		
  	}

	//define the getUrl() function
	 public function getUrl(){
   		 //the GET superglobal can fetch params from the url
   		 echo $_GET['url'];
		}
}


?>