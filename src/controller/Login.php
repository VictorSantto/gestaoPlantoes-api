<?php

	/**
	 * Generated by Getz Framework.
	 * 
	 * @author  Mario Sakamoto <mskamot@gmail.com>
	 * @see     http://wtag.com.br/getz
	 * @since   1.0.0
	 * @version 1.0.0
	 */
	
	namespace src\controller;
	use lib\getz;
	use src\logic;
	use src\model;

	class Login extends getz\Activator {
		
		public function __construct() { }
		
		public function init() {
			enableCORS();
			if ($_SERVER[REQUEST_METHOD] == strtoupper(GET)) {
				$this->daoFactory->beginTransaction();
				$usuariosDao = $this->daoFactory->getUsuariosDao();
				$where = USUARIOS . DOT . CPF . WHITE_SPACE . EQUALS . WHITE_SPACE . DOUBLE_QUOTES . "111.111.111-11" . 
						DOUBLE_QUOTES . WHITE_SPACE . STRING_AND . WHITE_SPACE . USUARIOS . DOT . SITUACAO_REGISTRO . 
						WHITE_SPACE . EQUALS . WHITE_SPACE . NUMBER_ONE;
				$usuariosList = $usuariosDao->read($where , STRING_EMPTY, false);
				if (is_array($usuariosList) && sizeof($usuariosList) > NUMBER_ZERO) {
					$usuarios = $usuariosList[NUMBER_ZERO];
					$token = new model\Token();
					$token->setUsuario($usuarios->getUsuario());
					$token->setCpf($usuarios->getCpf());
					$token->setFoto($usuarios->getFoto());
					$this->response[RESPONSE][JWT] = logic\JWT::create($token->jsonSerialize());
					$this->response[RESPONSE][STATUS] = NUMBER_TWO_HUNDRED;
					$this->response[RESPONSE][MESSAGE] = SUCCESS;
				} else {
					$this->response[RESPONSE][STATUS] = NUMBER_FIVE_HUNDRED;
					$this->response[RESPONSE][MESSAGE] = FALHA_AO_EFETUAR_O_LOGIN;	
				}
				$this->daoFactory->close();
			} else {
				$this->response[RESPONSE][STATUS] = NUMBER_FOUR_HUNDRED;
				$this->response[RESPONSE][MESSAGE] = BAD_REQUEST;	
			}
			echo json_encode($this->response, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
		}
	}
?>