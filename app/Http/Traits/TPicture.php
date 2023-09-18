<?php


namespace App\Http\Traits;


Trait TPicture
{

    //public $picture;

    /**
     * @return mixed
     */
    public function getPicture()
    {
        if (!$this->picture) {
            return asset('assets/common/img/no_image.png');
        }

        return asset("uploads/{$this->picture}");
    }


}
