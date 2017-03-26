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

namespace tool_dataexplorer\output;

use flexible_table;
use xmldb_table;

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->libdir.'/tablelib.php');

/**
 * database_table class.
 *
 * @package    tool_dataexplorer
 * @copyright  2017 Daniel Thee Roperto
 * @author     Daniel Thee Roperto <daniel@theeroperto.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class database_table extends flexible_table {
    public function __construct() {
        global $PAGE;

        parent::__construct('tool_dataexplorer_database_table');

        $this->define_baseurl($PAGE->url);
        $this->set_attribute('class', 'generaltable admintable');

        $this->define_columns(['table', 'description']);

        $this->define_headers(
            [
                get_string('tableheader_database_table', 'tool_dataexplorer'),
                get_string('tableheader_database_description', 'tool_dataexplorer'),
            ]
        );

        $this->setup();
    }

    /**
     * Sets the data of the table.
     *
     * @param xmldb_table[] $tables
     */
    public function show_data(array $tables) {
        foreach ($tables as $name => $table) {
            $this->add_data(
                [
                    $name,
                    $table['comment'],
                ]
            );
        }
        $this->finish_output();
    }
}
