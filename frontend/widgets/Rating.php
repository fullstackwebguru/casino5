<?php

namespace frontend\widgets;

use Yii;

class Rating extends \yii\base\Widget
{
    /**
     * @var array the alert types configuration for the flash messages.
     * This array is setup as $key => $value, where:
     * - $key is the name of the session flash variable
     * - $value is the bootstrap alert type (i.e. danger, success, info, warning)
     */
    public $ratesTemplate = [
        'orange' => [
            'filled' => '<i class="glyphicon glyphicon-star orange"></i>',
            'half' => '<i class="glyphicon glyphicon-star half orange"></i>',
            'unfilled'  => '<i class="glyphicon glyphicon-star black"></i>',
            'class1' => 'rate-wrapp',
            'class2' => 'rate-number',
            'class3' => 'stars-wrapper',
        ], 
        'red' => [
            'filled'   => '<i class="glyphicon glyphicon-star red-size-comp"></i>',
            'half' => '<i class="glyphicon glyphicon-star half red-size-comp"></i>',
            'unfilled'  => '<i class="glyphicon glyphicon-star black-size-comp"></i>',
            'class1' => 'rate-wrapp-comp',
            'class2' => 'rate-numb-comp',
            'class3' => 'stars-wrapper-comp',
        ],
        'side' => [
            'filled'   => '<i class="glyphicon glyphicon-star red-size"></i>',
            'half'   => '<i class="glyphicon glyphicon-star half half-comp red-size"></i> ',
            'unfilled'  => '<i class="glyphicon glyphicon-star black-size"></i>',
            'class1' => 'rate-wrapp-guide',
            'class2' => 'rate-number-gui',
            'class3' => 'stars-wrapper',
        ],
        'category' => [
            'filled'   => '<i class="glyphicon glyphicon-star red-size"></i>',
            'half'   => '<i class="glyphicon glyphicon-star half red-size"></i>',
            'unfilled'  => '<i class="glyphicon glyphicon-star black-size"></i>',
            'class2' => 'rate-number',
            'class3' => 'stars-wrapper',  
        ]
    ];

    /**
     * @var array the options for rendering 
     */
    public $rating;
    public $type;
    public $max_rating;
    public $min_rating;
    public $num_stars;


    public $link_url;
    public $show_review;

    public function init()
    {
        parent::init();

        if ($this->rating === null) {
            $this->rating = 0;
        }

        if ($this->max_rating === null) {
            $this->max_rating = 10;
        }

        if ($this->min_rating === null) {
            $this->min_rating = 0;
        }

        if ($this->num_stars === null) {
            $this->num_stars = 5;
        }

        if ($this->type == null) {
            $this->type = "orange";
        }

        if ($this->link_url == null) {
            $this->link_url = "javascript:void(0)";
        }

        if ($this->show_review == null) {
            $this->show_review = 0;
        }
    }

    public function run()
    {
        $currRating = min($this->rating, $this->max_rating);

        $interval = ($this->max_rating - $this->min_rating) / $this->num_stars;
        $value = floor($currRating / $interval);

        $halfFlag = false;

        if ($currRating - $value * $interval >= ($interval/2) ) {
            $halfFlag = true;;
        }

        $html = '';
        if (isset($this->ratesTemplate[$this->type]['class1'])) {
            $html .= '<div class="' . $this->ratesTemplate[$this->type]['class1'] . '">';    
        }
        
        $html .= '<p class="' . $this->ratesTemplate[$this->type]['class2'] . '"><a href="' . $this->link_url . '">' . $this->rating . '</a></p>';
        $html .= '<div class="' . $this->ratesTemplate[$this->type]['class3'] . '">';

        for ($i=0; $i< $value; $i++) {
            $html .= $this->ratesTemplate[$this->type]['filled'];
        }

        if ($halfFlag) {
            $html .= $this->ratesTemplate[$this->type]['half'];
            $i++;
        }

        for (; $i < $this->num_stars; $i++) {
            $html .= $this->ratesTemplate[$this->type]['unfilled'];
        }

        $html .= '</div>';
        if (isset($this->ratesTemplate[$this->type]['class1'])) {
            if ($this->show_review != 0 ) {
                $html .= '<a href="' . $this->link_url . '" class="read-r">Read Review</a>';
            }
            $html .= '</div>';
        }

        return $html;
    }
}
