<?php
//error_reporting(-1);
//ini_set("display_errors", "On");
session_start();
?>

<html lang="en">
<head>
    <title>Superglobals</title>
    <style type="text/css">
        .block {
            display: inline-block;
            width: 30px;
            height: 30px;
            padding: 0;
            margin: 0;
        }

        .block:hover {
            background-color: lightgray;
        }

        .red {
            background-color: red;
        }

        .blue {
            background-color: blue;
        }

        .green {
            background-color: green;
        }

        .gray {
            background-color: gray;
        }

        .white {
            background-color: white;
        }
    </style>
</head>
<body>
<br/>
<form method="post">
    <label>
        Columns:
        <input type="text" name="sx">
    </label>
    <label>
        Rows:
        <input type="text" name="sz">
    </label>
    <input type="submit" value="Change">
</form>
<form method="post">
    <label>
        Color:
        <select name="color">
            <option value="gray">Gray</option>
            <option value="red">Red</option>
            <option value="green">Green</option>
            <option value="blue">Blue</option>
        </select>
    </label>
    <input type="submit" value="Change">
</form>

</body>
<?php
function drawing($par1, $par2)
{
    $tmp = explode(',', $par1);
    $x1 = $tmp[0];
    $y1 = $tmp[1];
    $tmp = explode( ',', $par2);
    $x2 = $tmp[0];
    $y2 = $tmp[1];
    array_push($_SESSION['helper_tab'], $par1, $par2);


    // zmienne pomocnicze
     $x = $x1;
     $y = $y1;
     // ustalenie kierunku rysowania
     if ($x1 < $x2)
     {
         $xi = 1;
         $dx = $x2 - $x1;
     }
     else
     {
         $xi = -1;
         $dx = $x1 - $x2;
     }
     // ustalenie kierunku rysowania
     if ($y1 < $y2)
     {
         $yi = 1;
         $dy = $y2 - $y1;
     }
     else
     {
         $yi = -1;
         $dy = $y1 - $y2;
     }
     // pierwszy piksel
     //glVertex2i(x, y);
    array_push($_SESSION['helper_tab'], $x.','.$y);
     // oś wiodąca OX
     if ($dx > $dy)
     {
         $ai = ($dy - $dx) * 2;
         $bi = $dy * 2;
         $d = $bi - $dx;
         // pętla po kolejnych x
         while ($x != $x2)
         {
             // test współczynnika
             if ($d >= 0)
             {
                $x += $xi;
                 $y += $yi;
                 $d += $ai;
             }
             else
             {
                 $d += $bi;
                 $x += $xi;
             }
             array_push($_SESSION['helper_tab'], $x.','.$y);
         }
     }
     // oś wiodąca OY
     else
     {
         $ai = ( $dx - $dy ) * 2;
         $bi = $dx * 2;
         $d = $bi - $dy;
         // pętla po kolejnych y
         while ($y != $y2)
         {
             // test współczynnika
             if ($d >= 0)
             {
                 $x += $xi;
                 $y += $yi;
                 $d += $ai;
             }
             else
             {
                 $d += $bi;
                 $y += $yi;
             }
             array_push($_SESSION['helper_tab'], $x.','.$y);
         }
     }
}
if(isset($_POST['color']) && (!isset($_COOKiE['color'])))
{
    setcookie('color', $_POST['color']);
    $color = $_POST['color'];
}
elseif(!isset($_POST['color']) && (!isset($_COOKIE['color'])))
{
    $color = 'gray';
}
else
    {
    $color = $_COOKIE['color'];
}
if(!isset($_SESSION['sx']) && (!isset($_SESSION['sz'])))
{
    $_SESSION['sz'] = 10;
    $_SESSION['sx'] = 10;
}
if(isset($_POST['sx']))
{
    $_SESSION['sx']=$_POST['sx'];
}
if(isset($_POST['sz']))
{
    $_SESSION['sz']=$_POST['sz'];
}
if(!isset($_SESSION['control']))
{
    $_SESSION['control'] = 0;
}
if(!isset($_SESSION['helper_tab']))
{
    $_SESSION['helper_tab'] = [];
}
if(isset($_GET['x'], $_GET['z']))
{
    if($_SESSION['control']==0)
    {
        $_SESSION['xy'] = $_GET['x'].','.$_GET['z'];
        $_SESSION['control'] = 1;
    }
    elseif ($_SESSION['control']==1)
    {
        drawing($_SESSION['xy'], $_GET['x'].','.$_GET['z']);
        $_SESSION['control'] = 0;
    }
        for ($i = 0; $i < $_SESSION['sz']; $i++) {
        echo "<div>";
        for ($j = 0; $j < $_SESSION['sx']; $j++) {
            $tmp = $i.','.$j;
            $check = false;
            for($z=0; $z<sizeof($_SESSION['helper_tab']); $z++)
            {
                if($tmp==$_SESSION['helper_tab'][$z])
                {
                    $check = true;
                    break;
                }
            }
            if ($check) echo '<a class="block ' . 'white' . '" href=?x=' . $i . '&z=' . $j . '"></a>';
            else echo '<a class="block ' . $color . '" href=?x=' . $i . '&z=' . $j . '"></a>';
        }
        echo "</div>";
    }
}
else{
        for ($i = 0; $i < $_SESSION['sz']; $i++)
    {
        echo "<div>";
        for ($j = 0; $j < $_SESSION['sx']; $j++) {
            echo '<a class="block ' . $color . '" href=?x=' . $i . '&z=' . $j . '"></a>';
        }
        echo "</div>";
    }
}

//if(isset($_GET['x'], $_GET['z']))
//{
//    if($_SESSION['control']==1)
//    {
//        if(!isset($_SESSION['helper_tab']))
//        {
//            $_SESSION['helper_tab'] = [];
//        }
//        drawing($_SESSION['xy'], $_GET['x'].','.$_GET['z']);
//        $_SESSION['control'] = 0;
//    }
//    else
//    {
//        $_SESSION['xy'] = $_GET['x'].','.$_GET['z'];
//        $_SESSION['control'] = 1;
//    }
//
//}
//if((!isset($_SESSION['control']) || $_SESSION['control'] == 0) && (!isset($_SESSION['helper_tab']) || empty($_SESSION['helper_tab'])))
//{
//    for ($i = 0; $i < $_SESSION['sz']; $i++)
//    {
//        echo "<div>";
//        for ($j = 0; $j < $_SESSION['sx']; $j++) {
//            echo '<a class="block ' . $color . '" href=?x=' . $i . '&z=' . $j . '"></a>';
//        }
//        echo "</div>";
//    }
//}
//else{
//    for ($i = 0; $i < $_SESSION['sz']; $i++) {
//        echo "<div>";
//        for ($j = 0; $j < $_SESSION['sx']; $j++) {
//            $tmp = $i.','.$j;
//            $check = false;
//            for($z=0; $z<sizeof($_SESSION['helper_tab']); $z++)
//            {
//                if($tmp==$_SESSION['helper_tab'][$z])
//                {
//                    $check = true;
//                    break;
//                }
//            }
//            if ($check) echo '<a class="block ' . 'white' . '" href=?x=' . $i . '&z=' . $j . '"></a>';
//            else echo '<a class="block ' . $color . '" href=?x=' . $i . '&z=' . $j . '"></a>';
//        }
//        echo "</div>";
//    }
//
//}

?>
</html>
