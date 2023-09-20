<?php
session_start();
session_unset($_SESSION['username']);
session_unset($_SESSION['id_user']);
session_destroy();
header('location: .././');
