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
	
	class Alterar_a_minha_senha extends getz\Activator {
		
		public function __construct() { }
		
		public function init() {
			enableCORS();
			if ($_SERVER[REQUEST_METHOD] == strtoupper(POST)) {
				$alterar_a_minha_senhaInput = new model\Alterar_a_minha_senhaInput($this->request);
				if ($alterar_a_minha_senhaInput->isValid(POST)) {
					foreach (getallheaders() as $name => $value) {
						if ($name == AUTHORIZATION) {
							$token = base64_decode($value);
							$tokenMath = explode(G3TZ, $token);
							$userId = ($tokenMath[NUMBER_ONE] / NUMBER_ONE_HUNDRED_TWENTY_EIGHT) - NUMBER_THIRTY_TWO;
							$this->daoFactory->beginTransaction();
							$usuariosDao = $this->daoFactory->getUsuariosDao();
							$where = USUARIOS . DOT . ID . WHITE_SPACE . EQUALS . WHITE_SPACE . DOUBLE_QUOTES . 
									$userId . DOUBLE_QUOTES;
							$usuariosList = $usuariosDao->read($where , STRING_EMPTY, false);
							if (is_array($usuariosList) && sizeof($usuariosList) > NUMBER_ZERO) {
								$usuarios = $usuariosList[NUMBER_ZERO];
								$this->log->write(POST, $usuarios->getId(), $this->debug);
								$usuarios->setSenha(md5($alterar_a_minha_senhaInput->getSenha()));
								$usuarios->setPassword_token(STRING_EMPTY);
								$usuarios->setPassword_token_expiration(DEFAULT_DATE);
								$result = $usuariosDao->update($usuarios);
								$this->log->write(POST, $usuariosDao->getLog(), $this->debug);
								if ($result) {
									$this->daoFactory->commit();
									$this->response[RESPONSE][STATUS] = NUMBER_TWO_HUNDRED;
									$this->response[RESPONSE][MESSAGE] = SUCCESS;	
								} else {
									$this->daoFactory->rollback();	
									$this->response[RESPONSE][STATUS] = NUMBER_FIVE_HUNDRED;
									$this->response[RESPONSE][MESSAGE] = INTERNAL_SERVER_ERROR;	
								}
							} else {
								$this->response[RESPONSE][STATUS] = NUMBER_FOUR_HUNDRED;
								$this->response[RESPONSE][MESSAGE] = FALHA_AO_ENCONTRAR_O_USUARIO;
							}
							$this->daoFactory->close();	
						}
					}
				} else {
					$this->response[RESPONSE][STATUS] = NUMBER_FOUR_HUNDRED;
					$this->response[RESPONSE][MESSAGE] = $usuariosInput->getError();
				}
			} else {
				$this->response[RESPONSE][STATUS] = NUMBER_FOUR_HUNDRED;
				$this->response[RESPONSE][MESSAGE] = BAD_REQUEST;	
			}
			echo json_encode($this->response, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
		}
	}
?>