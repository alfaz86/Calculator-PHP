<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator-PHP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        $buttons = [1,2,3,'+',4,5,6,'-',7,8,9,'*','C',0,'.','/','='];
        $pressed = '';
        if (isset($_POST['pressed']) && in_array($_POST['pressed'], $buttons)) {
            $pressed = $_POST['pressed'];
        }
        $stored = '';
        if (isset($_POST['stored']) && preg_match('~^(?:[\d.]+[*/+-]?)+$~', $_POST['stored'], $out)) {
            $stored = $out[0];  
        }
        $display = $stored . $pressed;
        if ($pressed == 'C') {
            $display = '';
        } elseif ($pressed == '=' && preg_match('~^\d*\.?\d+(?:[*/+-]\d*\.?\d+)*$~', $stored)) {
            $display .= eval("return $stored;");
        }
    ?>
    <div id="main">
        <form action="\" method="post">
            <div id=body>
                <h2>Calculator-PHP</h2>
                <table>
                    <tr>
                        <input type="text" id="viewer" value="<?= $display ?>" autocomplete="off"/>
                    </tr>
            
                    <?php foreach (array_chunk($buttons, 4) as $chunk) { ?>
                        <tr>
                            <?php foreach ($chunk as $button) { ?>
                                <td <?= $button === '=' ? 'colspan="4"' : '' ?>>
                                    <button class="btn" name="pressed" value="<?= $button ?>" 
                                    <?= $button === '=' ? ' style="width: 360px;"' : '' ?>><?= $button ?></button>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </table>
                <input type="hidden" name="stored" value="<?= $display ?>">
            </div>
        </form>
    </div>
</body>
</html>