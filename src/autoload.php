<?php
/**
 * Autoloader do SDK Sicoob
 * 
 * Carrega automaticamente as classes do SDK
 * 
 * @package SicoobSDK
 * @author Sicoob SDK Team
 */

// Registra o autoloader
spl_autoload_register(function ($class) {
    // Verifica se a classe pertence ao namespace SicoobSDK
    if (strpos($class, 'SicoobSDK\\') !== 0) {
        return;
    }
    
    // Remove o namespace SicoobSDK\ do início
    $class = substr($class, 10);
    
    // Converte namespace separators em directory separators
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    
    // Constrói o caminho do arquivo
    $file = __DIR__ . DIRECTORY_SEPARATOR . 'SicoobSDK' . DIRECTORY_SEPARATOR . $class . '.php';
    
    // Verifica se o arquivo existe e o carrega
    if (file_exists($file)) {
        require_once $file;
    }
}); 