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
 * Data Explorer Admin Tool Settings
 *
 * @package    tool_dataexplorer
 * @copyright  2017 Daniel Thee Roperto
 * @author     Daniel Thee Roperto <daniel@theeroperto.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @var $ADMIN admin_root
 * @var $CFG stdClass
 */

defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {
    $ADMIN->add(
        'development',
        new admin_category('tool_dataexplorer', new lang_string('pluginname', 'tool_dataexplorer'))
    );

    $ADMIN->add(
        'tool_dataexplorer',
        new admin_externalpage(
            'tool_dataexplorer_database',
            get_string('dataexplorer_database', 'tool_dataexplorer'),
            new moodle_url("/{$CFG->admin}/tool/dataexplorer/database-explorer.php")
        )
    );
}
