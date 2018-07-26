<?php
/**
 * @Copyright
 *
 * @package    PWD-GEN J! - Password Generator
 * @author     Viktor Vogel {@link http://joomla-extensions.kubik-rubik.de/}
 * @version    3-2 - 2013-12-24
 * @link       Project Site {@link http://joomla-extensions.kubik-rubik.de/pwd-gen-j-password-generator}
 *
 * @license    GNU/GPL
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
defined('_JEXEC') or die('Restricted access');

require_once(dirname(__FILE__).'/helper.php');

$password_lengths = array_unique(array_map('trim', explode(',', $params->get('password_lengths', '8,10,12,16,20'))));
sort($password_lengths);
$password_numbers = array_unique(array_map('trim', explode(',', $params->get('password_numbers', '1,2,3,5,10,20,30'))));
sort($password_numbers);
$password_types = $params->get('password_types');
$copy = $params->get('copy', 1);

$password_generator = new ModPasswordGeneratorHelper($params);
$output = $password_generator->getOutput();

require(JModuleHelper::getLayoutPath('mod_password_generator', 'default'));