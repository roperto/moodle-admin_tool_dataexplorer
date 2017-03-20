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
 */

// NOTE: no MOODLE_INTERNAL test here, this file may be required by behat before including /config.php.

use auth_outage\dml\outagedb;
use auth_outage\local\outage;
use Behat\Gherkin\Node\TableNode;
use Behat\Mink\Exception\ExpectationException;

require_once(__DIR__.'/../../../../../lib/behat/behat_base.php');

/**
 * Steps definitions related to tool_dataexplorer.
 *
 * @package    tool_dataexplorer
 * @copyright  2017 Daniel Thee Roperto
 * @author     Daniel Thee Roperto <daniel@theeroperto.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @SuppressWarnings(public) Allow as many methods as needed.
 */
class behat_tool_dataexplorer extends behat_base {
    /**
     * @Given /^there is a tool dataexplorere context$/
     */
    public function there_is_a_tool_dataexplorere_context() {
        // Do nothing.
    }
}
