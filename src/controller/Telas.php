<?php

	/**
	 * Generated by Getz Framework.
	 * 
	 * @author  Mario Sakamoto <mskamot@gmail.com>
	 * @see     https://wtag.com.br/getz
	 * @since   1.0.0
	 * @version 1.0.0
	 */
	 
	namespace src\controller;
	use lib\getz;
	use src\model;
	
	class Telas extends getz\Activator {
		
		public function __construct() { }
		
		public function init() {
			enableCORS();
			if ($_SERVER[REQUEST_METHOD] == strtoupper(POST)) {
				$telasInput = new model\TelasInput($this->request);
				if ($telasInput->isValid(POST)) {
					$this->daoFactory->beginTransaction();
					$telasDao = $this->daoFactory->getTelasDao();
					$result = $telasDao->create($telasInput->getEntity());
					$this->log->write(POST, $telasDao->getLog(), $this->debug);
					$insertId = $telasDao->getInsertId();
					if ($result) {		
						$telasList = $telasDao->read(TELAS . DOT . ID . WHITE_SPACE . EQUALS . 
								WHITE_SPACE . $insertId, STRING_EMPTY, false);
						$this->log->write(GET, $telasDao->getLog(), $this->debug);
						$telasOutput = new model\TelasOutput();
						$this->response[RESPONSE][TELAS][VALUE] = $telasOutput->getOutputList(
								$telasList);									
						$this->response[RESPONSE][TELAS][SIZE] = sizeOf(
								$this->response[RESPONSE][TELAS][VALUE]);							
						$this->daoFactory->commit();
						$this->response[RESPONSE][STATUS] = NUMBER_TWO_HUNDRED;
						$this->response[RESPONSE][MESSAGE] = SUCCESS;								
					} else {												
						$this->daoFactory->rollback();								
						$this->response[RESPONSE][STATUS] = NUMBER_FIVE_HUNDRED;
						$this->response[RESPONSE][MESSAGE] = INTERNAL_SERVER_ERROR;
					}
					$this->daoFactory->close();					
				} else {
					$this->response[RESPONSE][STATUS] = NUMBER_FOUR_HUNDRED;
					$this->response[RESPONSE][MESSAGE] = $telasInput->getError();
				}
			} else if ($_SERVER[REQUEST_METHOD] == strtoupper(GET)) {
				if ($this->resource != STRING_EMPTY) {
					$this->where = TELAS . DOT . ID . WHITE_SPACE . EQUALS . WHITE_SPACE . $this->resource;	
				}
				if ($this->order == STRING_EMPTY) {
					$this->order = TELAS . DOT . ID . WHITE_SPACE . DESC;
				}
				$this->daoFactory->beginTransaction();
				$telasDao = $this->daoFactory->getTelasDao();
				$telasList = $telasDao->read($this->where, $this->order, $this->hasPagination);	
				$this->log->write(GET, $telasDao->getLog(), $this->debug);
				$telasOutput = new model\TelasOutput();
				$this->response[RESPONSE][TELAS][VALUE] = $telasOutput->getOutputList($telasList);													
				$this->daoFactory->close();				
				if ($this->hasPagination) {
					$this->response[RESPONSE][TELAS][SIZE] = $telasDao->getSize();
					if ($this->response[RESPONSE][TELAS][SIZE] == NUMBER_ZERO) {
						$this->response[RESPONSE] = null;
						$this->response[RESPONSE][MESSAGE] = DATA_NOT_FOUND;
					}
				} else {
					$this->response[RESPONSE][TELAS][SIZE] = sizeOf(
							$this->response[RESPONSE][TELAS][VALUE]);	
					if ($this->response[RESPONSE][TELAS][SIZE] == NUMBER_ZERO) {
						$this->response[RESPONSE] = null;
						$this->response[RESPONSE][MESSAGE] = DATA_NOT_FOUND;
					}
				}
				$this->response[RESPONSE][STATUS] = NUMBER_TWO_HUNDRED;
			} else if ($_SERVER[REQUEST_METHOD] == strtoupper(PUT)) {		
				if ($this->resource != STRING_EMPTY && !empty($this->request) && $this->request[ID] == 
						$this->resource) {
					$telasInput = new model\TelasInput($this->request);
					if ($telasInput->isValid(PUT)) {
						$this->daoFactory->beginTransaction();
						$telasDao = $this->daoFactory->getTelasDao();
						$telasList = $telasDao->read(TELAS . DOT . ID . WHITE_SPACE . EQUALS . 
								WHITE_SPACE . $this->resource, STRING_EMPTY, false);
						$this->log->write(GET, $telasDao->getLog(), $this->debug);
						if (!is_null($telasList) && sizeOf($telasList) > NUMBER_ZERO) {
							$result = $telasDao->update($telasInput->getEntity());
							$this->log->write(PUT, $telasDao->getLog(), $this->debug);	
							if ($result) {	
								$telasList = $telasDao->read(TELAS . DOT . ID . WHITE_SPACE . EQUALS . 
										WHITE_SPACE . $this->resource, STRING_EMPTY, false);
								$this->log->write(GET, $telasDao->getLog(), $this->debug);
								$telasOutput = new model\TelasOutput();
								$this->response[RESPONSE][TELAS][VALUE] = $telasOutput->getOutputList(
										$telasList);									
								$this->response[RESPONSE][TELAS][SIZE] = sizeOf(
										$this->response[RESPONSE][TELAS][VALUE]);							
								$this->daoFactory->commit();
								$this->response[RESPONSE][STATUS] = NUMBER_TWO_HUNDRED;
								$this->response[RESPONSE][MESSAGE] = SUCCESS;									
							} else {							
								$this->daoFactory->rollback();
								$this->response[RESPONSE][STATUS] = NUMBER_FIVE_HUNDRED;
								$this->response[RESPONSE][MESSAGE] = INTERNAL_SERVER_ERROR;
							}
						} else {
							$this->response[RESPONSE][STATUS] = NUMBER_TWO_HUNDRED;
							$this->response[RESPONSE][MESSAGE] = DATA_NOT_FOUND;	
						}
						$this->daoFactory->close();
					} else {
						$this->response[RESPONSE][STATUS] = NUMBER_FOUR_HUNDRED;
						$this->response[RESPONSE][MESSAGE] = $telasInput->getError();
					}
				} else {
					$this->response[RESPONSE][STATUS] = NUMBER_FOUR_HUNDRED;
					$this->response[RESPONSE][MESSAGE] = BAD_REQUEST;	
				}
			} else if ($_SERVER[REQUEST_METHOD] == strtoupper(DELETE)) {
				if ($this->resource != STRING_EMPTY) {
					$this->daoFactory->beginTransaction();
					$telasDao = $this->daoFactory->getTelasDao();
					$telasList = $telasDao->read(TELAS . DOT . ID . WHITE_SPACE . EQUALS . WHITE_SPACE . 
							$this->resource, STRING_EMPTY, false);
					$this->log->write(GET, $telasDao->getLog(), $this->debug);
					if (!is_null($telasList) && sizeOf($telasList) > NUMBER_ZERO) {
						$result = $telasDao->delete($telasList[NUMBER_ZERO]);
						$this->log->write(DELETE, $telasDao->getLog(), $this->debug);	
						if ($result) {
							$this->daoFactory->commit();
							$this->response[RESPONSE][STATUS] = NUMBER_TWO_HUNDRED;
							$this->response[RESPONSE][MESSAGE] = SUCCESS;							
						} else {
							$this->daoFactory->rollback();
							$this->response[RESPONSE][STATUS] = NUMBER_FIVE_HUNDRED;
							$this->response[RESPONSE][MESSAGE] = INTERNAL_SERVER_ERROR;	
						}
						$this->daoFactory->close();	
					} else {
						$this->response[RESPONSE][STATUS] = NUMBER_TWO_HUNDRED;
						$this->response[RESPONSE][MESSAGE] = DATA_NOT_FOUND;	
					}
				} else {
					$this->response[RESPONSE][STATUS] = NUMBER_FOUR_HUNDRED;
					$this->response[RESPONSE][MESSAGE] = BAD_REQUEST;	
				}				
			} else {
				$this->response[RESPONSE][STATUS] = NUMBER_FOUR_HUNDRED;
				$this->response[RESPONSE][MESSAGE] = BAD_REQUEST;	
			}
			echo json_encode($this->response, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
		}
		
	}

?>