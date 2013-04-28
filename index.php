<?php

//підключаєм адміністраторські настройки
require_once "configs/admin_configs.php";
//підключаєм настойки сайту
require_once "configs/site_configs.php";

//викликаєм роутер
Router::route();