<?php

	/**
	 * Autoload.
	 * 
	 * @author  Mario Sakamoto <mskamot@gmail.com>
	 * @see     http://wtag.com.br/getz
	 * @since   1.0.0
	 * @version 1.0.0, 26 Jul 2016
	 */
	 
	use lib\getz;
	use src\logic;
	
	header("Content-Type: application/json; charset=utf-8");		
	
	/*
	 * SPL autoload register.
	 */
	spl_autoload_register(function ($autoload) {
		if (!@include(__DIR__ . BAR .  str_replace(BACKSLASH, BAR, $autoload) . DOT . PHP)) { 
			$applicationSettings = simplexml_load_file(APPLICATION_SETTINGS);
			$root = STRING_EMPTY;
			if ($applicationSettings->package != STRING_EMPTY) {
				$root = BAR . $applicationSettings->package;		
			}		
			header(LOCATION . $root . BAR . NOT_FOUND);
		}
	});
	
	define("CONSTANTS", "Constants.php");
	define("MESSAGES", "Messages.php");
	define("UTIL_PACKAGE", "lib/getz/Util.php");	
	define("VENDOR_AUTOLOAD", "vendor/autoload.php");
	
	require_once(CONSTANTS);
	require_once(MESSAGES);
	require_once(UTIL_PACKAGE);	
	require_once(VENDOR_AUTOLOAD);

	/*
	 * Application settings.
     */	 
	$applicationSettings = simplexml_load_file(APPLICATION_SETTINGS);
	$root = STRING_EMPTY;
	if ($applicationSettings->package != STRING_EMPTY) {
		$root = BAR . $applicationSettings->package;		
	}
	$debug = false;	
	if ($applicationSettings->debug != STRING_EMPTY && $applicationSettings->debug == STRING_TRUE) {
		$debug = true;
	}
	$documentRoot = $_SERVER[DOCUMENT_ROOT] . $root;
	$daoFactoryIsOfficial = $applicationSettings->connection->is_official;	
	$_JWT = $applicationSettings->jwt;
	define("JWT", $_JWT);
	$class = $_GET[STRING_CLASS];	 

	$daoFactory = new logic\DaoFactory($daoFactoryIsOfficial);
	$log = new getz\Log();
	$request = array();

	/*
	 * PUT rules.
	 */
	if ($_SERVER[REQUEST_METHOD] == strtoupper(PUT)) {
		$putFo = fopen(PHP_INPUT, R);
		$putData = STRING_EMPTY;
		while ($data = fread($putFo, NUMBER_ONE_THOUSAND_TWENTY_FOUR * NUMBER_ONE_THOUSAND_TWENTY_FOUR)) {
			$putData .= $data;
		}
		fclose($putFo);
		$request = json_decode(str_replace(REQUEST . EQUALS, STRING_EMPTY, $putData), true);
	} else if (isset($_POST[REQUEST])) {
		$request = json_decode($_POST[REQUEST], true);
	}
	
	$response = array();
	$resource = $daoFactory->prepare($_GET[RESOURCE]);
	
	/*
	 * Where.
	 */
	$filterColumn = $daoFactory->prepare($_GET[FILTER_COLUMN]);
	$filterCondition = $daoFactory->prepare($_GET[FILTER_CONDITION]);
	$filterValue = $daoFactory->prepare($_GET[FILTER_VALUE]);
	$where = STRING_EMPTY;
	if ($filterColumn != STRING_EMPTY && $filterCondition != STRING_EMPTY && $filterValue != STRING_EMPTY) {
		$filterColumnList = explode(SEMICOLON, $filterColumn);
		$filterConditionList = explode(SEMICOLON, $filterCondition);
		$filterValueList = explode(SEMICOLON, $filterValue);
		$filterAnd = STRING_EMPTY;
		for ($x = NUMBER_ZERO; $x < sizeof($filterColumnList); $x++) {
			if ($x > NUMBER_ZERO) {
				$filterAnd = WHITE_SPACE . STRING_AND . WHITE_SPACE;
			}
			if (strtoupper($filterConditionList[$x]) == strtoupper(STRING_EQUALS)) {
				$where .= $filterAnd . $filterColumnList[$x] . WHITE_SPACE . EQUALS . WHITE_SPACE . DOUBLE_QUOTES . 
						$filterValueList[$x] . DOUBLE_QUOTES;		
			} else if (strtoupper($filterConditionList[$x]) == strtoupper(STRING_NOT_EQUALS)) {
				$where .= $filterAnd . $filterColumnList[$x] . WHITE_SPACE . NOT_EQUALS . WHITE_SPACE . DOUBLE_QUOTES . 
						$filterValueList[$x] . DOUBLE_QUOTES;					
			} else if (strtoupper($filterConditionList[$x]) == strtoupper(LIKE)) {
				$where .= $filterAnd . $filterColumnList[$x] . WHITE_SPACE . LIKE . WHITE_SPACE . DOUBLE_QUOTES . PERCENTAGE . 
						$filterValueList[$x] . PERCENTAGE . DOUBLE_QUOTES;				
			} else if (strtoupper($filterConditionList[$x]) == strtoupper(STRING_BETWEEN)) {
				$where .= $filterAnd . $filterColumnList[$x] . WHITE_SPACE . BETWEEN . WHITE_SPACE . $filterValueList[$x];	
			} else if (strtoupper($filterConditionList[$x]) == strtoupper(STRING_LESS_THAN)) {
				$where .= $filterAnd . $filterColumnList[$x] . WHITE_SPACE . LESS_THAN . WHITE_SPACE . $filterValueList[$x];		
			} else if (strtoupper($filterConditionList[$x]) == strtoupper(STRING_LESS_EQUALS)) {
				$where .= $filterAnd . $filterColumnList[$x] . WHITE_SPACE . LESS_EQUALS . WHITE_SPACE . $filterValueList[$x];		
			} else if (strtoupper($filterConditionList[$x]) == strtoupper(STRING_MORE_THAN)) {
				$where .= $filterAnd . $filterColumnList[$x] . WHITE_SPACE . MORE_THAN . WHITE_SPACE . $filterValueList[$x];		
			} else if (strtoupper($filterConditionList[$x]) == strtoupper(STRING_MORE_EQUALS)) {
				$where .= $filterAnd . $filterColumnList[$x] . WHITE_SPACE . MORE_EQUALS . WHITE_SPACE . $filterValueList[$x];
			} else if (strtoupper($filterConditionList[$x]) == strtoupper(IN)) {
				$where .= $filterAnd . $filterColumnList[$x] . WHITE_SPACE . IN . WHITE_SPACE . LEFT_PARENTHESES . 
						$filterValueList[$x] . RIGHT_PARENTHESES;
			} else if (strtoupper($filterConditionList[$x]) == strtoupper(STRING_NOT_IN)) {
				$where .= $filterAnd . $filterColumnList[$x] . WHITE_SPACE . NOT_IN . WHITE_SPACE . LEFT_PARENTHESES . 
						$filterValueList[$x] . RIGHT_PARENTHESES;
			}
		}
	}

	/*
	 * Order.
	 */
	$orderColumn = $daoFactory->prepare($_GET[ORDER_COLUMN]);
	$orderValue = $daoFactory->prepare($_GET[ORDER_VALUE]);
	$order = STRING_EMPTY;
	if ($orderColumn != STRING_EMPTY) {
		if ($orderValue == STRING_EMPTY) {
			$orderValue = ASC;
		}
		$order = $orderColumn . WHITE_SPACE . $orderValue;
	}	
	
	/*
	 * Limits.
	 */
	$page = $daoFactory->prepare($_GET[PAGE]);
	$pageSize = $daoFactory->prepare($_GET[PAGE_SIZE]); 
	$hasPagination = false;
	if ($pageSize == STRING_EMPTY) {
		$pageSize = NUMBER_TEN;
	}
	if ($page > NUMBER_ZERO) {
		$hasPagination = true;
		if ($order != STRING_EMPTY) {
			$order .= WHITE_SPACE . LIMIT . WHITE_SPACE . (($page * $pageSize) - $pageSize) . COMMA . 
					$pageSize;
		} else {
			$order = LIMIT . WHITE_SPACE . (($page * $pageSize) - $pageSize) . COMMA . $pageSize;
		}
	}

	/*
	 * The controller.
	 */
	$controller = SRC_CONTROLLER . ucfirst($class);
	$instance = new $controller;
	$instance->setClass($class);		
	$instance->setDaoFactory($daoFactory);		
	$instance->setDebug($debug);
	$instance->setDocumentRoot($documentRoot);
	$instance->setHasPagination($hasPagination);	
	$instance->setLog($log);		
	$instance->setRequest($request);
	$instance->setResponse($response);
	$instance->setWhere($where);
	$instance->setOrder($order);
	$instance->setResource($resource);
	$instance->init();

?>