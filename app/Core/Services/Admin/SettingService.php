<?php

namespace App\Core\Services\Admin;

use App\Core\Services\AbstractService;
use App\Core\Repositories\SettingRepository;

class SettingService extends AbstractService
{
    public function __construct(protected SettingRepository $settingRepository)
    {
        parent::__construct($settingRepository);
    }




}
