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

class ModPasswordGeneratorHelper extends JObject
{
    protected $_output;
    protected $_special_characters;

    function __construct($params)
    {
        $css = '#pwd-main div {padding-bottom: 6px;}';
        $css .= '#pwd-main .pwd-label {width: 150px; display:inline-block;}';
        $css .= '#pwd-main label {display:inline-block;}';

        $document = JFactory::getDocument();
        $document->addStyleDeclaration($css);

        $output = '';
        $input = JFactory::getApplication()->input;

        $pwd_generate = $input->get('pwd_generate');

        if(!empty($pwd_generate))
        {
            $this->_special_characters = array_unique(array_map('trim', explode(',', $params->get('password_specialcharacters', '!,#,$,%,(,),*,+,-,.,/,:,;,=,?,_,€,@'))));
            $pwd_type = $input->get('pwd_type');
            $pwd_quantity = $input->get('pwd_quantity');
            $pwd_size = $input->get('pwd_size');

            $css = '.pwd_output {display: inline-block; font: 1.5em/1.5 Monaco,Consolas,"Courier News",monospace !important; margin-bottom: 5px; text-align: center; width: 100%;}';
            $document->addStyleDeclaration($css);

            $output = '<span class="pwd_output">';

            if($pwd_type == 1)
            {
                for($i = 0; $i < $pwd_quantity; $i++)
                {
                    $output .= htmlspecialchars(base64_decode($this->pw($input, $pwd_size))).'<br />';
                }
            }
            elseif($pwd_type == 2)
            {
                for($i = 0; $i < $pwd_quantity; $i++)
                {
                    $output .= htmlspecialchars(base64_decode($this->pweasy($pwd_size))).'<br />';
                }
            }
            elseif($pwd_type == 3)
            {
                for($i = 0; $i < $pwd_quantity; $i++)
                {
                    $output .= htmlspecialchars(base64_decode($this->pwsafe($pwd_size))).'<br />';
                }
            }

            $output .= '</span><br />';
        }

        $this->set('_output', $output);
    }

    /**
     * Type 1 - selected checkboxes
     *
     * @param JInput $input
     * @param string $pwd_size
     *
     * @return string
     */
    private function pw($input, $pwd_size)
    {
        $chars_low = array();
        $chars_up = array();
        $chars_numb = array();
        $chars_special = array();

        $pwd_low = $input->get('pwd_low');

        if(!empty($pwd_low))
        {
            $chars_low = range('a', 'z');
        }

        $pwd_up = $input->get('pwd_up');

        if(!empty($pwd_up))
        {
            $chars_up = range('A', 'Z');
        }

        $pwd_numbers = $input->get('pwd_numbers');

        if(!empty($pwd_numbers))
        {
            $chars_numb = range(0, 9);
        }

        $pwd_special = $input->get('pwd_special');

        if(!empty($pwd_special))
        {
            $chars_special = $this->_special_characters;
        }

        $items = array_merge($chars_low, $chars_up, $chars_numb, $chars_special);

        if(!empty($items))
        {
            $pw = '';

            for($i = 0; $i < $pwd_size; $i++)
            {
                $pw .= $items[mt_rand(0, count($items) - 1)];
            }
        }
        else
        {
            $pw = '';
        }

        return base64_encode($pw);
    }

    /**
     * Type 2 - Easy mode
     *
     * @param string $pwd_size
     *
     * @return string
     */
    private function pweasy($pwd_size)
    {
        $chars_low_v = array('a', 'e', 'u', 'i', 'o');
        $chars_low_k = array('b', 'c', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'm', 'n', 'p', 'q', 'r', 's', 't', 'v', 'w', 'x', 'y', 'z');
        $chars_numb = range(0, 9);

        $pw_l = $pwd_size / 2 - 1;
        $pw_l2 = $pwd_size / 2;

        $char = mt_rand($pw_l, $pw_l2);
        $numb = $pwd_size - $char * 2;

        $char_l1 = mt_rand(0, $char);
        $char_l2 = $char - $char_l1;

        $numb_l1 = mt_rand(0, $numb);
        $numb_l2 = $numb - $numb_l1;

        $pw = '';

        for($i = 0; $i < $char_l1; $i++)
        {
            $pw .= $chars_low_k[mt_rand(0, count($chars_low_k) - 1)];
            $pw .= $chars_low_v[mt_rand(0, count($chars_low_v) - 1)];
        }

        for($i = 0; $i < $numb_l1; $i++)
        {
            $pw .= $chars_numb[mt_rand(0, count($chars_numb) - 1)];
        }

        for($i = 0; $i < $char_l2; $i++)
        {
            $pw .= $chars_low_k[mt_rand(0, count($chars_low_k) - 1)];
            $pw .= $chars_low_v[mt_rand(0, count($chars_low_v) - 1)];
        }

        for($i = 0; $i < $numb_l2; $i++)
        {
            $pw .= $chars_numb[mt_rand(0, count($chars_numb) - 1)];
        }

        return base64_encode($pw);
    }

    /**
     * Type 3 - Safe mode
     *
     * @param string $pwd_size
     *
     * @return string
     */
    private function pwsafe($pwd_size)
    {
        $chars_low = range('a', 'z');
        $chars_up = range('A', 'Z');
        $chars_numb = range(0, 9);
        $chars_special = $this->_special_characters;
        $all_char = array_merge($chars_low, $chars_up, $chars_numb, $chars_special);

        $items = array($chars_low[mt_rand(0, count($chars_low) - 1)], $chars_low[mt_rand(0, count($chars_low) - 1)], $chars_up[mt_rand(0, count($chars_up) - 1)], $chars_up[mt_rand(0, count($chars_up) - 1)], $chars_numb[mt_rand(0, count($chars_numb) - 1)], $chars_numb[mt_rand(0, count($chars_numb) - 1)], $chars_special[mt_rand(0, count($chars_special) - 1)], $chars_special[mt_rand(0, count($chars_special) - 1)]);

        for($i = 8; $i < $pwd_size; $i++)
        {
            $items[$i] = $all_char[mt_rand(0, count($all_char) - 1)];
        }

        shuffle($items);

        if(!empty($items))
        {
            $pw = '';

            for($i = 0; $i < $pwd_size; $i++)
            {
                $pw .= $items[$i];
            }
        }
        else
        {
            $pw = '';
        }

        return base64_encode($pw);
    }

    /**
     * Returns the generated passwords
     *
     * @return mixed
     */
    public function getOutput()
    {
        return $this->_output;
    }
}
