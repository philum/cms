<?
session_start();

require("../../prog/lib.php");
require("../../prog/styl.php");
echo '<html><head>';
echo '
	<link rel="stylesheet" href="css/colorpicker.css" type="text/css" />
    <link rel="stylesheet" media="screen" type="text/css" href="css/layout.css" />
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/colorpicker.js"></script>
    <script type="text/javascript" src="js/eye.js"></script>
    <script type="text/javascript" src="js/layout.php"></script>';//?ver=1.0.2

echo '</head>';

echo f_inp_clr_manage_j();

echo '<body>
</body>
</html>';
?>