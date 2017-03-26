<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Data Explorer
 *
 * @package    tool_dataexplorer
 * @copyright  2017 Daniel Thee Roperto
 * @author     Daniel Thee Roperto <daniel@theeroperto.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_dataexplorer\local\database;

use cache;

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->libdir.'/tablelib.php');

/**
 * database class.
 *
 * @package    tool_dataexplorer
 * @copyright  2017 Daniel Thee Roperto
 * @author     Daniel Thee Roperto <daniel@theeroperto.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class database {
    /**
     * @return database
     */
    public static function get() {
        $cache = cache::make('tool_dataexplorer', 'application');
        $dedb = $cache->get('database');
        if ($dedb === false) {
            $dedb = self::generate();
        }
        return $dedb;
    }

    private static function generate() {
        global $DB;

        $tables = $DB->get_manager()->get_install_xml_schema()->getTables();
        usort($tables, function($a, $b) {
            return strcmp($a->getName(), $b->getName());
        });

        $dedb = new database();
        foreach ($tables as $table) {
            $dedb->tables[$table->getName()] = [
                'comment' => $table->getComment(),
            ];
        }

        $cache = cache::make('tool_dataexplorer', 'application');
        $cache->set('database', $dedb);
        return $dedb;
    }

    private function __construct() {
    }

    private $tables = [];

    public function get_tables() {
        return $this->tables;
    }
}
