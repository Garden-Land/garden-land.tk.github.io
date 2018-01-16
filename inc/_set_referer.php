<?PHP 
# Тут вставляем в куки ID referera
if(isset($_GET["ref"])){
$_rid = (intval($_GET["ref"]) > 0) ? intval($_GET["ref"]) : 1; 
setcookie("i",$_rid,time()+2592000);
header("Location: /");
}
?>