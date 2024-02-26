<?php

echo view('theme/login/header.php');
if (isset($mainContent)) echo view($mainContent);
echo view('theme/login/footer.php');
