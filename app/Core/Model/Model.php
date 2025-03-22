<?php

namespace App\Core\Model;

use App\Traits\HasMedia;
use App\Traits\ModelScopes;
use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{
    use HasMedia, ModelScopes;
}
