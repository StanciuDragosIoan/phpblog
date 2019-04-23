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
				//print_r($this->getUrl());		
				
				$url = $this->getUrl();

				//check in the controllers for the first param of the url (to see if there is any controller with the name of that param)
				if(file_exists('../app/controllers/' . ucwords($url[0]). '.php')){
						//set as the param as the current controller
						$this->currentController = ucwords($url[0]);
						//unset 0 index of the URL params
						unset($url[0]);
				}

				//require the controller 
				require_once('../app/controllers/' . $this->currentController . '.php');

				//instantiate the controller
				$this->currentController = new $this->currentController;

				//check for second part of url (for param[1] index)
				if(isset($url[1])){
						//check to see if method exists in controller
						if(method_exists($this->currentController, $url[1])){
							$this->currentMethod = $url[1];

							//unset index 1 in url
							unset($url[1]);
						}
				}

				//get params
				$this->params = $url ? array_values($url) : [];

				//call a callback with array of params
				call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
  	}

	//define the getUrl() function
	 public function getUrl(){
   		 //the GET superglobal can fetch params from the url
			 //  echo $_GET['url'];
			 
			 //Check to see if the param of the url is set
			 if(isset($_GET['url'])){
				 //strip the '/' after the param (if any)
				$url = rtrim($_GET['url'], '/');
				//sanitize the url as a url (filter the vars as a url format-remove chars that should not be into an array)
				$url = filter_var($url, FILTER_SANITIZE_URL);
				$url = explode('/', $url);
				return $url;
			 }	
		}
}


?>