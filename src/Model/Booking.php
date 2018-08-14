<?php
declare(strict_types = 1);

namespace Model;


class Booking
{
    protected $id;
    protected $showTime_id;
    protected $user_id;


    public function __construct(int $id, int $showTime_id, int $user_id)
    {
        $this->id          = $id;
        $this->showTime_id = $showTime_id;
        $this->user_id     = $user_id;
    }


}