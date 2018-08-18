<?php

namespace App\Helpers;

use Illuminate\Http\Request;

abstract class BaseType
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var
     */
    protected $slug;

    /**
     * @var
     */
    protected $files;


    /**
     * @var
     */
    protected $height;

    /**
     * Password constructor.
     *
     * @param Request $request
     * @param $slug
     * @param $row
     */
    public function __construct(Request $request, $slug, $files, $path = '')
    {
        $this->request = $request;
        $this->slug = $slug;
        $this->files = $files;
        $this->path = $path;
    }

    /**
     * @return mixed
     */
    abstract public function handle();
}
