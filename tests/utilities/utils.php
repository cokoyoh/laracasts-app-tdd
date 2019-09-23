<?php

function create($class, array $attributes = [], $count = null)
{
return factory($class, $count)->create($attributes);
}

function make($class, array $attributes = [], $count = null)
{
return factory($class, $count)->make($attributes);
}

function raw($class, array $attributes = [])
{
return factory($class)->raw($attributes);
}
