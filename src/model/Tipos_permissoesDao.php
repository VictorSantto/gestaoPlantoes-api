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
	
	class Tipos_permissoesDao {
		
		private $connection;
		private $size;
		private $log;
		private $columns = TIPOS_PERMISSOES . DOT. ID . WHITE_SPACE . STRING_AS . WHITE_SPACE . DOUBLE_QUOTES . TIPOS_PERMISSOES . DOT . ID . DOUBLE_QUOTES . COMMA . WHITE_SPACE . TIPOS_PERMISSOES . DOT. TIPO_PERMISSAO . WHITE_SPACE . STRING_AS . WHITE_SPACE . DOUBLE_QUOTES . TIPOS_PERMISSOES . DOT . TIPO_PERMISSAO . DOUBLE_QUOTES . COMMA . WHITE_SPACE . TIPOS_PERMISSOES . DOT. CADASTRADO . WHITE_SPACE . STRING_AS . WHITE_SPACE . DOUBLE_QUOTES . TIPOS_PERMISSOES . DOT . CADASTRADO . DOUBLE_QUOTES . COMMA . WHITE_SPACE . TIPOS_PERMISSOES . DOT. MODIFICADO . WHITE_SPACE . STRING_AS . WHITE_SPACE . DOUBLE_QUOTES . TIPOS_PERMISSOES . DOT . MODIFICADO . DOUBLE_QUOTES;
		
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
		
		public function create($tipos_permissoes) {
			$query = INSERT . WHITE_SPACE . INTO . WHITE_SPACE . TIPOS_PERMISSOES . WHITE_SPACE . LEFT_PARENTHESES . TIPO_PERMISSAO . COMMA . WHITE_SPACE . CADASTRADO . COMMA . WHITE_SPACE . MODIFICADO . COMMA . WHITE_SPACE . COR . RIGHT_PARENTHESES . WHITE_SPACE . VALUES . WHITE_SPACE . LEFT_PARENTHESES . DOUBLE_QUOTES . $tipos_permissoes->getTipo_permissao() . DOUBLE_QUOTES . COMMA . WHITE_SPACE . DOUBLE_QUOTES . $tipos_permissoes->getCadastrado() . DOUBLE_QUOTES . COMMA . WHITE_SPACE . DOUBLE_QUOTES . $tipos_permissoes->getModificado() . DOUBLE_QUOTES . COMMA . WHITE_SPACE . DOUBLE_QUOTES . $tipos_permissoes->getCores()->getId() . DOUBLE_QUOTES . RIGHT_PARENTHESES;
			$this->setLog($query);
			return $this->connection->execute($query);
		}

		public function read($where, $order, $hasPagination) {
			$count = NUMBER_ZERO;
			if ($where != STRING_EMPTY) {
				$where = WHERE . WHITE_SPACE . $where . WHITE_SPACE . STRING_AND . WHITE_SPACE . TIPOS_PERMISSOES . DOT . COR . WHITE_SPACE . EQUALS . WHITE_SPACE. CORES . DOT . ID;
			} else {
				$where = WHERE . WHITE_SPACE . TIPOS_PERMISSOES . DOT . COR . WHITE_SPACE . EQUALS . WHITE_SPACE. CORES . DOT . ID;
			}
			if ($order != STRING_EMPTY) {
				$order = ORDER_BY . WHITE_SPACE . $order;
			}
			$coresDao = new model\CoresDao($this->connection);
			$query = SELECT . WHITE_SPACE . $this->columns . COMMA . WHITE_SPACE . $coresDao->getColumns() . WHITE_SPACE . FROM . WHITE_SPACE . TIPOS_PERMISSOES . WHITE_SPACE . TIPOS_PERMISSOES . COMMA . WHITE_SPACE . CORES . WHITE_SPACE . CORES . WHITE_SPACE . $where;
			$this->setLog($query . WHITE_SPACE . $order);
			$result = $this->connection->execute($query . WHITE_SPACE . $order);
			$tipos_permissoesList = array();
			while ($row = $result->fetch_assoc()) {
				$tipos_permissoes = new model\Tipos_permissoes();
				$tipos_permissoes->setId($row[TIPOS_PERMISSOES . POINT . ID]);
				$tipos_permissoes->setTipo_permissao($row[TIPOS_PERMISSOES . POINT . TIPO_PERMISSAO]);
				$tipos_permissoes->setCadastrado($row[TIPOS_PERMISSOES . POINT . CADASTRADO]);
				$tipos_permissoes->setModificado($row[TIPOS_PERMISSOES . POINT . MODIFICADO]);
				$cores = new model\Cores();
				$cores->setId($row[CORES . DOT . ID]);
				$cores->setCor($row[CORES . DOT . COR]);
				$tipos_permissoes->setCores($cores);
				$tipos_permissoesList[$count] = $tipos_permissoes;
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
			return $tipos_permissoesList;
		}

		public function update($tipos_permissoes) {
			$query = UPDATE . WHITE_SPACE . TIPOS_PERMISSOES . WHITE_SPACE . SET . WHITE_SPACE . ID . WHITE_SPACE . EQUALS . 
					WHITE_SPACE . DOUBLE_QUOTES . $tipos_permissoes->getId() . DOUBLE_QUOTES;
			if (!is_null($tipos_permissoes->getTipo_permissao()) && !empty($tipos_permissoes->getTipo_permissao())) {
				$query .= COMMA . WHITE_SPACE . TIPO_PERMISSAO . WHITE_SPACE . EQUALS . WHITE_SPACE . DOUBLE_QUOTES . 
						$tipos_permissoes->getTipo_permissao() . DOUBLE_QUOTES;
			}
			if (!is_null($tipos_permissoes->getCores()) && !empty($tipos_permissoes->getCores()->getId()) &&  
					!empty($tipos_permissoes->getCores()->getId())) {
				$query .= COMMA . WHITE_SPACE . COR . WHITE_SPACE . EQUALS . WHITE_SPACE . DOUBLE_QUOTES . 
						$tipos_permissoes->getCores()->getId() . DOUBLE_QUOTES;
			}
			$query .= COMMA . WHITE_SPACE . MODIFICADO . WHITE_SPACE . EQUALS . WHITE_SPACE . DOUBLE_QUOTES . 
					$tipos_permissoes->getModificado() . DOUBLE_QUOTES . WHITE_SPACE . WHERE . WHITE_SPACE . ID . EQUALS . 
					$tipos_permissoes->getId();
			$this->setLog($query);
			return $this->connection->execute($query);
		}

		public function delete($tipos_permissoes) {
			$query = DELETE . WHITE_SPACE . FROM . WHITE_SPACE . TIPOS_PERMISSOES . WHITE_SPACE . WHERE . WHITE_SPACE . ID . 
					WHITE_SPACE . EQUALS . WHITE_SPACE . $tipos_permissoes->getId();
			$this->setLog($query);
			return $this->connection->execute($query);
		}

	}

?>