<?php

echo view('theme/app/header.php');
if (isset($mainContent)) echo view($mainContent);
echo view('theme/app/footer.php');
