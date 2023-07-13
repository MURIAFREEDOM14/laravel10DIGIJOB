<?php

namespace App\Services;

use Intervention\Image\Image;
use \Intervention\Image\ImageManager;

Class SlidingCaptcha
{
    public $manager;
    public Image $top;
    public Image $bottom;
    public int $position;

    CONST CANVAS_HEIGHT = 200;
    CONST CANVAS_WIDTH = 4000;
    CONST CANVAS_BG = '#F0F0F0';

    public function __construct(Imagemanager $manager)
    {
        $this->manager = $manager;
        $this->generate();
    }

    private function generate()
    {
        $image = $this->createImage();

        $this->bottom = clone $image;
        $this->top    = clone $image;

        $this->bottom->crop(2000,50,0,50);

        $this->position = random_int(0,160)*10;  // ensures steps of 10

        $this->top->crop(400,50,$this->position,0);
        
        $this->position = 2000-$this->position;

        return;
    }

    private function createImage()
    {
        $image = $this->manager->canvas(self::CANVAS_WIDTH, self::CANVAS_HEIGHT, self::CANVAS_BG);
                
        foreach(range(1,70) as $x) {
            $image->circle(
                random_int(0,self::CANVAS_HEIGHT),  // diameter
                random_int(0,self::CANVAS_WIDTH),   // x
                random_int(0,self::CANVAS_HEIGHT),  // y
                function ($draw) {
                    $draw->background($this->colours());
                    $draw->border(1, '#444');
                });
        }

        $image->resize(self::CANVAS_WIDTH/2, self::CANVAS_HEIGHT/2);

        return $image;
    }

    private function colours()
    {
        return [
            random_int(0,255),  // range for R
            random_int(0,255),  // range for G
            random_int(0,255),  // range for B
            (rand(1,8)/10)      // range for opacity
        ];
    }
}