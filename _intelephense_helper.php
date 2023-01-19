<?php

namespace Illuminate\Contracts\View;

use Illuminate\Contracts\Support\Renderable;

interface View extends Renderable
{
  public function extends();
  public function layout();
  public function layoutData();
  public function section();
  public function slot();
}
