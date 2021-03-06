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

	class Situacoes_registros {
			
		private $id;
		private $situacao_registro;
		private $cadastrado;
		private $modificado;
		private $cores;
			
		public function __construct() { }
			
		public function getId() {
			return $this->id;
		}
		
		public function setId($id) {
			$this->id = $id;
		}		
					
		public function getSituacao_registro() {
			return $this->situacao_registro;
		}
		
		public function setSituacao_registro($situacao_registro) {
			$this->situacao_registro = $situacao_registro;
		}		
					
		public function getCadastrado() {
			return $this->cadastrado;
		}
		
		public function setCadastrado($cadastrado) {
			$this->cadastrado = $cadastrado;
		}		
					
		public function getModificado() {
			return $this->modificado;
		}
		
		public function setModificado($modificado) {
			$this->modificado = $modificado;
		}		
					
		public function getCores() {
			return $this->cores;
		}
		
		public function setCores($cores) {
			$this->cores = $cores;
		}		
					
	}
	
?>