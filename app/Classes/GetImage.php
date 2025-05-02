<?php
namespace App\Classes;

abstract class GetImage
{
    private string $imageName;
    private string $pathToImage;

    public function __construct($imageName, $pathToImage =  "app/public/image/")
    {
        $this->imageName = $imageName;
        $this->pathToImage = $pathToImage;
    }


}
