<SCRIPT LANGUAGE="JavaScript">
function test() {
return '자바스크립트에서 가져왔다zzzzz', 'ho';
}
</SCRIPT>
<?php
echo '<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />';
ob_start();
echo "<script>var a = test(); document.write(a);</script>";
$a = ob_get_clean();
echo $a;
?>