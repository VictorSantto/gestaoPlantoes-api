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

	class Tipos_permissoes {
			
		private $id;
		private $tipo_permissao;
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
					
		public function getTipo_permissao() {
			return $this->tipo_permissao;
		}
		
		public function setTipo_permissao($tipo_permissao) {
			$this->tipo_permissao = $tipo_permissao;
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