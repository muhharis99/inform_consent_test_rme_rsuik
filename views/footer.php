<div class="clearfix"></div>
<hr>

<div class="row">
<?php
if(count($widget) > 0)
{
  foreach ($widget as $all) {
    # code...
    $position = $all->position;
    $name = $all->name;

    if($position == 'bottom')
    {
      widget(str_replace(' ', '_', $name));
    }
  }
}
?>
</div>

<hr>
