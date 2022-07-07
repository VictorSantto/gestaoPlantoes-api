<?php
			
	/**
	 * Generated by Getz Framework.
	 * 
	 * @author  Mario Sakamoto <mskamot@gmail.com>
	 * @see     https://wtag.com.br/getz 
	 * @since   1.0.0
	 * @version 1.0.0	 
	 */
	 
	namespace src\model; 
	use src\model;
	
	class TelasDao {
		
		private $connection;
		private $size;
		private $log;
		private $columns = TELAS . DOT. ID . WHITE_SPACE . STRING_AS . WHITE_SPACE . DOUBLE_QUOTES . TELAS . DOT . ID . DOUBLE_QUOTES . COMMA . WHITE_SPACE . TELAS . DOT. TELA . WHITE_SPACE . STRING_AS . WHITE_SPACE . DOUBLE_QUOTES . TELAS . DOT . TELA . DOUBLE_QUOTES . COMMA . WHITE_SPACE . TELAS . DOT. IDENTIFICADOR . WHITE_SPACE . STRING_AS . WHITE_SPACE . DOUBLE_QUOTES . TELAS . DOT . IDENTIFICADOR . DOUBLE_QUOTES . COMMA . WHITE_SPACE . TELAS . DOT. CADASTRADO . WHITE_SPACE . STRING_AS . WHITE_SPACE . DOUBLE_QUOTES . TELAS . DOT . CADASTRADO . DOUBLE_QUOTES . COMMA . WHITE_SPACE . TELAS . DOT. MODIFICADO . WHITE_SPACE . STRING_AS . WHITE_SPACE . DOUBLE_QUOTES . TELAS . DOT . MODIFICADO . DOUBLE_QUOTES;
		
		public function __construct($connection) {
			$this->connection = $connection;
		}
		
		public function getInsertId() {
			return $this->connection->getInsertId();
		}

		public function getSize() {
			return $this->size;
		}

		private function setLog($log) {
			$this->log = $log;
		}
		
		public function getLog() {
			return $this->log;
		}
		
		public function getColumns() {
			return $this->columns;
		}
		
		public function create($telas) {
			$query = INSERT . WHITE_SPACE . INTO . WHITE_SPACE . TELAS . WHITE_SPACE . LEFT_PARENTHESES . TELA . COMMA . WHITE_SPACE . IDENTIFICADOR . COMMA . WHITE_SPACE . CADASTRADO . COMMA . WHITE_SPACE . MODIFICADO . COMMA . WHITE_SPACE . MENU . RIGHT_PARENTHESES . WHITE_SPACE . VALUES . WHITE_SPACE . LEFT_PARENTHESES . DOUBLE_QUOTES . $telas->getTela() . DOUBLE_QUOTES . COMMA . WHITE_SPACE . DOUBLE_QUOTES . $telas->getIdentificador() . DOUBLE_QUOTES . COMMA . WHITE_SPACE . DOUBLE_QUOTES . $telas->getCadastrado() . DOUBLE_QUOTES . COMMA . WHITE_SPACE . DOUBLE_QUOTES . $telas->getModificado() . DOUBLE_QUOTES . COMMA . WHITE_SPACE . DOUBLE_QUOTES . $telas->getMenus()->getId() . DOUBLE_QUOTES . RIGHT_PARENTHESES;
			$this->setLog($query);
			return $this->connection->execute($query);
		}

		public function read($where, $order, $hasPagination) {
			$count = NUMBER_ZERO;
			if ($where != STRING_EMPTY) {
				$where = WHERE . WHITE_SPACE . $where . WHITE_SPACE . STRING_AND . WHITE_SPACE . TELAS . DOT . MENU . WHITE_SPACE . EQUALS . WHITE_SPACE. MENUS . DOT . ID;
			} else {
				$where = WHERE . WHITE_SPACE . TELAS . DOT . MENU . WHITE_SPACE . EQUALS . WHITE_SPACE. MENUS . DOT . ID;
			}
			if ($order != STRING_EMPTY) {
				$order = ORDER_BY . WHITE_SPACE . $order;
			}
			$menusDao = new model\MenusDao($this->connection);
			$query = SELECT . WHITE_SPACE . $this->columns . COMMA . WHITE_SPACE . $menusDao->getColumns() . WHITE_SPACE . FROM . WHITE_SPACE . TELAS . WHITE_SPACE . TELAS . COMMA . WHITE_SPACE . MENUS . WHITE_SPACE . MENUS . WHITE_SPACE . $where;
			$this->setLog($query . WHITE_SPACE . $order);
			$result = $this->connection->execute($query . WHITE_SPACE . $order);
			$telasList = array();
			while ($row = $result->fetch_assoc()) {
				$telas = new model\Telas();
				$telas->setId($row[TELAS . POINT . ID]);
				$telas->setTela($row[TELAS . POINT . TELA]);
				$telas->setIdentificador($row[TELAS . POINT . IDENTIFICADOR]);
				$telas->setCadastrado($row[TELAS . POINT . CADASTRADO]);
				$telas->setModificado($row[TELAS . POINT . MODIFICADO]);
				$menus = new model\Menus();
				$menus->setId($row[MENUS . DOT . ID]);
				$menus->setMenu($row[MENUS . DOT . MENU]);
				$telas->setMenus($menus);
				$telasList[$count] = $telas;
				$count++;
			}
			$this->connection->free($result);
			if ($hasPagination && $count > NUMBER_ZERO) {
				$result = $this->connection->execute($query);
				$size = NUMBER_ZERO;
				while ($row = $result->fetch_assoc()) {
					$size++;
				}
				$this->connection->free($result);				
				$this->size = $size;
			}
			return $telasList;
		}

		public function update($telas) {
			$query = UPDATE . WHITE_SPACE . TELAS . WHITE_SPACE . SET . WHITE_SPACE . ID . WHITE_SPACE . EQUALS . 
					WHITE_SPACE . DOUBLE_QUOTES . $telas->getId() . DOUBLE_QUOTES;
			if (!is_null($telas->getTela()) && !empty($telas->getTela())) {
				$query .= COMMA . WHITE_SPACE . TELA . WHITE_SPACE . EQUALS . WHITE_SPACE . DOUBLE_QUOTES . 
						$telas->getTela() . DOUBLE_QUOTES;
			}
			if (!is_null($telas->getIdentificador()) && !empty($telas->getIdentificador())) {
				$query .= COMMA . WHITE_SPACE . IDENTIFICADOR . WHITE_SPACE . EQUALS . WHITE_SPACE . DOUBLE_QUOTES . 
						$telas->getIdentificador() . DOUBLE_QUOTES;
			}
			if (!is_null($telas->getMenus()) && !empty($telas->getMenus()->getId()) &&  
					!empty($telas->getMenus()->getId())) {
				$query .= COMMA . WHITE_SPACE . MENU . WHITE_SPACE . EQUALS . WHITE_SPACE . DOUBLE_QUOTES . 
						$telas->getMenus()->getId() . DOUBLE_QUOTES;
			}
			$query .= COMMA . WHITE_SPACE . MODIFICADO . WHITE_SPACE . EQUALS . WHITE_SPACE . DOUBLE_QUOTES . 
					$telas->getModificado() . DOUBLE_QUOTES . WHITE_SPACE . WHERE . WHITE_SPACE . ID . EQUALS . 
					$telas->getId();
			$this->setLog($query);
			return $this->connection->execute($query);
		}

		public function delete($telas) {
			$query = DELETE . WHITE_SPACE . FROM . WHITE_SPACE . TELAS . WHITE_SPACE . WHERE . WHITE_SPACE . ID . 
					WHITE_SPACE . EQUALS . WHITE_SPACE . $telas->getId();
			$this->setLog($query);
			return $this->connection->execute($query);
		}

	}

?>