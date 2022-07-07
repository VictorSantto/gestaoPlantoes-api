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
	
	class Efetuar_o_login extends getz\Activator {
		
		public function __construct() { }
		
		public function init() {
			enableCORS();
			if ($_SERVER[REQUEST_METHOD] == strtoupper(POST)) {
				$efetuar_o_loginInput = new model\Efetuar_o_loginInput($this->request);
				if ($efetuar_o_loginInput->isValid(POST)) {
					$this->daoFactory->beginTransaction();
					$usuariosDao = $this->daoFactory->getUsuariosDao();
					$email = $efetuar_o_loginInput->getEmail();
					$senha = md5($efetuar_o_loginInput->getSenha());
					$where = USUARIOS . DOT . EMAIL . WHITE_SPACE . EQUALS . WHITE_SPACE . DOUBLE_QUOTES . $email . 
							DOUBLE_QUOTES . WHITE_SPACE . STRING_AND . WHITE_SPACE . USUARIOS . DOT . SENHA . 
							WHITE_SPACE . EQUALS . WHITE_SPACE . DOUBLE_QUOTES . $senha . DOUBLE_QUOTES . WHITE_SPACE .
							STRING_AND . WHITE_SPACE . USUARIOS . DOT . SITUACAO_REGISTRO . WHITE_SPACE . EQUALS . 
							WHITE_SPACE . NUMBER_ONE;
					$usuariosList = $usuariosDao->read($where , STRING_EMPTY, false);
					if (is_array($usuariosList) && sizeof($usuariosList) > NUMBER_ZERO) {
						$usuarios = $usuariosList[NUMBER_ZERO];
						$this->log->write(POST, $usuarios->getId(), $this->debug);
						$token = md5(uniqid(time())) . G3TZ . (($usuarios->getId() + NUMBER_THIRTY_TWO) * 
								NUMBER_ONE_HUNDRED_TWENTY_EIGHT);
						$usuarios->setAccess_token($token);
						$usuarios->setAccess_token_expiration(date(YMD_HIS, strtotime(MORE_THREE_HUNDRED_SIXTY_FIVE)));
						$result = $usuariosDao->update($usuarios);
						$this->log->write(POST, $usuariosDao->getLog(), $this->debug);
						if ($result) {
							$usuariosOutput = new model\UsuariosOutput();
							$tokenEncode = base64_encode($usuarios->getAccess_token());
							$usuariosOutput->setAccess_token($tokenEncode);
							$this->response[RESPONSE][USUARIOS][VALUE] = $usuariosOutput;									
							$this->daoFactory->commit();
							$this->response[RESPONSE][STATUS] = NUMBER_TWO_HUNDRED;
							$this->response[RESPONSE][MESSAGE] = SUCCESS;
						} else {
							$this->daoFactory->rollback();	
							$this->response[RESPONSE][STATUS] = NUMBER_FIVE_HUNDRED;
							$this->response[RESPONSE][MESSAGE] = INTERNAL_SERVER_ERROR;	
						}
					} else {
						$this->response[RESPONSE][STATUS] = NUMBER_FIVE_HUNDRED;
							$this->response[RESPONSE][MESSAGE] = FALHA_AO_EFETUAR_O_LOGIN;	
					}
					$this->daoFactory->close();
				} else {
					$this->response[RESPONSE][STATUS] = NUMBER_FOUR_HUNDRED;
					$this->response[RESPONSE][MESSAGE] = $efetuar_o_loginInput->getError();
				}
			} else {
				$this->response[RESPONSE][STATUS] = NUMBER_FOUR_HUNDRED;
				$this->response[RESPONSE][MESSAGE] = BAD_REQUEST;	
			}
			echo json_encode($this->response, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
		}
	}
?>