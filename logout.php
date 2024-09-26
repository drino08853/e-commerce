<?php
session_start();


session_destroy();

echo "<script>alert('Anda telah Logout');</script>";
echo "<script>window.location.href='index.php?page=login'</script>";
