<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $error = '';
    if (!isset($_POST['alias'])){
        $error = 'Algo ha ido mal';
    } else{
        $alias= htmlspecialchars(trim($_POST['alias'] ?? ''));
            if ($alias !== '') {
                if(strlen($alias) < 3){
                    $error = 'muy corto';
                } else {
                    $_SESSION['alias'] = $alias;
                    header('Location: login.php');
                    exit;
                }
            } else {
                $error = 'El alias no puede estar vacío';
            }
   
    }
    
}
?>
<form action="" method="post">
    <label for="alias">Alias:</label>
    
    <input type="text" name="alias" id="alias" required>
    <button type="submit">Enviar</button>
    <?php
    if($error)
        echo '<p>' . $error . '</p>';
    ?>
