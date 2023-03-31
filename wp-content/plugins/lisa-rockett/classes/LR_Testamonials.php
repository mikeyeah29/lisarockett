<?php

class LR_Testamonials
{
    static private $optionName = 'lr_testamonials';

    static public function add($data)
    {
        $testmionials = Self::get();

        $testmionials[] = array(
            'name' => $data['q_name'],
            'quote' => $data['q_message']
        );

        update_option(Self::$optionName, $testmionials);
    }

    static public function get()
    {
        return get_option(Self::$optionName, []);
    }

    static public function getOne($index)
    {
        $testimonials = Self::get();
        if (isset($testimonials[$index])) {
            return $testimonials[$index];
        }
        return null;
    }

    static public function update($index, $data)
    {
        $testimonials = Self::get();

        if (isset($testimonials[$index])) {
            $testimonials[$index]['name'] = $data['q_name'];
            $testimonials[$index]['quote'] = $data['q_message'];
            update_option(Self::$optionName, $testimonials);
            return true;
        }

        return false;
    }

    static public function remove($index)
    {
        $testimonials = Self::get();

        if (isset($testimonials[$index])) {
            unset($testimonials[$index]);
            $testimonials = array_values($testimonials);
            update_option(Self::$optionName, $testimonials);
            return true;
        }

        return false;
    }
}

?>
