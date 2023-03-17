
<?php
$controller = ucfirst(isset($_REQUEST['controller']) ? strtolower($_REQUEST['controller']) : 'home');
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'index';
// B2: Chuẩn hóa tên trước khi gọi
$controller .= 'Controller';
$controllerPath = './controllers/'.$controller.'.php';
// B3. Để gọi nó Controller
if(!file_exists($controllerPath)){
    die("Không tìm thấy file $controllerPath");
}
require_once($controllerPath);
$myObj = new $controller();
$myObj->$action();
?>