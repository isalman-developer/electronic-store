<?php

namespace App\Core\Repositories;

use App\Models\Setting;
use App\Core\Repositories\AbstractRepository;

class SettingRepository extends AbstractRepository {

    public function __construct(Setting $setting)
    {
        parent::__construct($setting);
    }

}
