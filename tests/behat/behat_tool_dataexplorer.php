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
 * Data Explorer Admin Tool Steps.
 *
 * @package    tool_dataexplorer
 * @copyright  2017 Daniel Thee Roperto
 * @author     Daniel Thee Roperto <daniel@theeroperto.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// NOTE: no MOODLE_INTERNAL test here, this file may be required by behat before including /config.php.

// This is a workaround for https://tracker.moodle.org/browse/MDL-58390 issue.
if (php_sapi_name() != 'cli') {
    return;
}

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
     * @Then /^I (.*) have access any PHP page inside dataexplorer$/
     */
    public function i_have_access_any_php_page_inside_dataexplorer($shouldsee) {
        global $CFG;

        $behatgeneral = behat_context_helper::get(behat_general::class);

        $iterator = new RegexIterator(
            new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($CFG->dirroot.'/admin/tool/dataexplorer/')
            ),
            '/^.+\.php$/i',
            RecursiveRegexIterator::GET_MATCH
        );

        $shouldsee = ($shouldsee == 'should');
        $index = strlen($CFG->dirroot);
        foreach ($iterator as $phpfile) {
            $url = $CFG->wwwroot.substr($phpfile[0], $index);
            $this->visitPath($url);
            $text = trim($this->getSession()->getPage()->getText());
            if (empty($text)) {
                continue; // Some pages like version.php or settings.php will not run anything.
            }
            try {
                if ($shouldsee) {
                    $behatgeneral->assert_page_not_contains_text('Access denied');
                    $behatgeneral->assert_page_contains_text('Data Explorer');
                } else {
                    $behatgeneral->assert_page_contains_text('Access denied');
                    $behatgeneral->assert_page_not_contains_text('Data Explorer');
                }
            } catch (ExpectationException $exception) {
                throw new ExpectationException(
                    "Potential security problem on [{$url}] with text [{$text}]",
                    $this->getSession(),
                    $exception
                );
            }
        }
    }
}
