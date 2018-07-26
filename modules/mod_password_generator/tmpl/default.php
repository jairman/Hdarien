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
echo '<!-- PWD-GEN J! - Password Generator - Kubik-Rubik Joomla! Extensions - Viktor Vogel -->';
?>
<div id="pwd-main">
    <form action="<?php echo JUri::current(); ?>#pwd-main" method="post" class="form-horizontal">
        <div>
            <span class="pwd-label">
                <label for="pwd_type"><?php echo JText::_('MOD_PASSWORD_GENERATOR_TYPE'); ?></label>
            </span>
            <select name="pwd_type" id="pwd_type" class="span12">
                <?php if(!empty($password_types)) : ?>
                    <option value="1" selected="selected"><?php echo JText::_('MOD_PASSWORD_GENERATOR_SELECTION'); ?></option>
                <?php endif; ?>
                <option value="2"><?php echo JText::_('MOD_PASSWORD_GENERATOR_EASY'); ?></option>
                <option value="3"><?php echo JText::_('MOD_PASSWORD_GENERATOR_SAFE'); ?></option>
            </select>
        </div>
        <?php if(!empty($password_types)) : ?>
            <div>
                <?php foreach($password_types as $password_type) : ?>
                    <?php if($password_type == 0) : ?>
                        <label for="pwd_upchar" class="checkbox inline">
                            <input type="checkbox" name="pwd_up" checked="checked" id="pwd_upchar" />
                            A-Z
                        </label>
                    <?php elseif($password_type == 1) : ?>
                        <label for="pwd_lowchar" class="checkbox inline">
                            <input type="checkbox" name="pwd_low" checked="checked" id="pwd_lowchar" />
                            a-z
                        </label>
                    <?php elseif($password_type == 2) : ?>
                        <label for="pwd_numbers" class="checkbox inline">
                            <input type="checkbox" name="pwd_numbers" checked="checked" id="pwd_numbers" />
                            0-9
                        </label>
                    <?php elseif($password_type == 3) : ?>
                        <label for="pwd_special" class="checkbox inline">
                            <input type="checkbox" name="pwd_special" checked="checked" id="pwd_special" />
                            #!%+*$...
                        </label>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <div>
        <div>
            <span class="pwd-label">
                <label for="pwd_size"><?php echo JText::_('MOD_PASSWORD_GENERATOR_LENGTH'); ?></label>
            </span>
            <select name="pwd_size" id="pwd_size" class="span12">
                <?php foreach($password_lengths as $password_length) : ?>
                    <?php if(is_numeric($password_length)) : ?>
                        <option value="<?php echo $password_length; ?>"><?php echo $password_length; ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <span class="pwd-label">
                <label for="pwd_quantity"><?php echo JText::_('MOD_PASSWORD_GENERATOR_QUANTITY'); ?></label>
            </span>
            <select name="pwd_quantity" id="quantity" class="span12">
                <?php foreach($password_numbers as $password_number) : ?>
                    <?php if(is_numeric($password_number)) : ?>
                        <option value="<?php echo $password_number; ?>"><?php echo $password_number; ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </div>
            <span class="pwd-label">
                <button class="btn" type="submit" name="pwd_generate" value="pwd_generate" />
                    <?php echo JText::_('MOD_PASSWORD_GENERATOR_GENERATE'); ?>
                </button>
            </span>
        </div>
    </form>
    <?php if(!empty($output)) : ?>
        <?php echo $output; ?>
    <?php endif; ?>
    <?php if($copy) : ?>
        <p class="small">
            <a href="http://joomla-extensions.kubik-rubik.de" target="_blank" title="Password Generator - Joomla! 3 - Kubik-Rubik Joomla! Extensions by Viktor Vogel">Kubik-Rubik Joomla! Extensions</a>
        </p>
    <?php endif; ?>
</div>