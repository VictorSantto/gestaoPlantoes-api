<?php

	/**
	 * Inject.
	 * 
	 * @author  Mario Sakamoto <mskamot@gmail.com>
	 * @see     http://wtag.com.br/getz
	 * @since   1.0.0
	 * @version 1.0.0, 26 Jul 2016
	 */
	 
	namespace lib\getz;
	
	class Inject {
	
		/**
		 * @param  {String} parameter
		 * @return {String}
		 */
		public function inject($parameter) {
			$statement = "";
			$statement = str_replace("\\", "", $parameter);
			$statement = str_replace("\"", "\\\"", $statement);
			return $statement;
		}

	}

?>