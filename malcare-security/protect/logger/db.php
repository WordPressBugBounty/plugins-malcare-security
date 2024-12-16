<?php
if (!defined('ABSPATH') && !defined('MCDATAPATH')) exit;

if (!class_exists('MCProtectLoggerDB_V588')) :
class MCProtectLoggerDB_V588 {
	private $tablename;
	private $bv_tablename;

	const MAXROWCOUNT = 100000;

	function __construct($tablename) {
		$this->tablename = $tablename;
		$this->bv_tablename = MCProtect_V588::$db->getBVTable($tablename);
	}

	public function log($data) {
		if (is_array($data)) {
			if (MCProtect_V588::$db->rowsCount($this->bv_tablename) > MCProtectLoggerDB_V588::MAXROWCOUNT) {
				MCProtect_V588::$db->deleteRowsFromtable($this->tablename, 1);
			}

			MCProtect_V588::$db->replaceIntoBVTable($this->tablename, $data);
		}
	}
}
endif;