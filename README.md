A micro view templating system for PHP
======================================

Usage:

    $registry = new UView\Registry('/path/of/view/files');
    # (...)
    try {
        # Will try to load '/path/of/view/files/page.php'
        $view = $registry->get('page');
    } catch (RuntimeException $ex) {
        die('Could not find view file');
    }
    $view->set('user_name', 'John Smith');
    $view->set('user_login', 'john.smith');

    echo $view;
