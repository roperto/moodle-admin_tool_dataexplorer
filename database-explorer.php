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
 * Data Explorer Landing Page
 *
 * @package     tool_dataexplorer
 * @copyright   2017 Daniel Thee Roperto
 * @author      Daniel Thee Roperto <daniel@theeroperto.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @var $CFG    stdClass
 * @var $PAGE   moodle_page
 * @var $OUTPUT core_renderer
 * @var $DB     moodle_database
 */

require(__DIR__.'/../../../config.php');
require_once($CFG->libdir.'/adminlib.php');

admin_externalpage_setup('tool_dataexplorer_database');
$PAGE->set_url(new moodle_url('/admin/tool/dataexplorer/database-explorer.php'));
echo $OUTPUT->header();

global $DB;

// Find all install.xml files and all tables.
$cache = cache::make('tool_dataexplorer', 'application');
$tables = $cache->get('tables');
if ($tables === false) {
    $tables = $DB->get_manager()->get_install_xml_schema()->getTables();
    usort($tables, function($a, $b) {
        return strcmp($a->getName(), $b->getName());
    });
    $cache->set('tables', $tables);
}

echo '<table>';
echo '<tr>';
echo '<th>table</th>';
echo '<th>comment</th>';
echo '</tr>';
foreach ($tables as $table) {
    /** @var $table xmldb_table */
    $fields = count($table->getFields());
    echo '<tr>';
    echo "<td>{$table->getName()}</td>";
    echo "<td>{$table->getComment()}</td>";
    echo '</tr>';
}
echo '</table>';

echo $OUTPUT->footer();
