<?php
	 
	namespace src\logic;
    use src\logic;

	class Authorization {

        private $jwt;
        
        public function __construct($authorizationToken = null) {
			if (isset($authorizationToken)) {
				$this->jwt = new logic\JWT($authorizationToken);
			} else if (isset($_COOKIE[JWT])) {
				$this->jwt = new logic\JWT($_COOKIE[JWT]);
			}
        }

        public function getToken() {
			if ($this->jwt != null) {
				return $this->jwt->getToken();
			} else {
				return null;
			}
        }
		
        public function isValid() {
			if ($this->jwt != null) {
				return $this->jwt->isValid();
			} else {
				return false;
			}
        }		
		
    }

?>