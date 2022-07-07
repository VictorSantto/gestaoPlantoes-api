<?php

	/**
	 * Log.
	 * 
	 * @author  Mario Sakamoto <mskamot@gmail.com>
	 * @see     http://wtag.com.br/getz
	 * @since   1.0.0
	 * @version 1.0.0, 26 Jul 2016
	 */	 
	 
	namespace lib\getz;
	use lib\getz;

	class EncryptFile {
	
		private $office_document = "vnd.openxmlformats-officedocument.wordprocessingml.document";
		private $file;
		private $name;
	
		public function __construct($base64) { 
			$splited = explode(COMMA, substr($base64, NUMBER_FIVE), NUMBER_TWO);
			$mimeSplited = $splited[NUMBER_ZERO];
			$this->file = $splited[NUMBER_ONE];
			$mime_split_without_base64 = explode(SEMICOLON, $mimeSplited, NUMBER_TWO);
			$mime_split = explode(BAR, $mime_split_without_base64[NUMBER_ZERO], NUMBER_TWO);
			$extension = STRING_EMPTY;
			if (count($mime_split) == NUMBER_TWO) {
				$extension = $mime_split[NUMBER_ONE];
				if ($extension == JPEG) {
					$extension = JPG;
				} else if ($extension == $this->office_document) {
					$extension = DOCX;
				}
				$this->name = md5(uniqid(time())) . POINT . $extension;
			}
		}
		
		public function moveToDoc($path, $from, $to) {
			file_put_contents(str_replace($from, $to, $path) . BAR . RES . BAR . DOC . BAR . $this->name, 
					str_replace(WHITE_SPACE, MORE, $this->file));	
		}

		public function getName() { 
			return $this->name;
		}
		
	}

?>