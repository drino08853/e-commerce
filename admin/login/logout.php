<?php

//memulai session
session_start();


//menghapus session
session_destroy();


echo "<script>
alert('Anda Telah Log Out !')
window.location.href='index.php'
</script>";
