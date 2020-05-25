<?php


class PostsController
{
    public function index()
    {
        $users =[
        ['username'=>'freakky', 'age'=>"18"],
        ['username'=>'frak', 'age'=>"27"]
            ];
//        $loader = new \Twig\Loader\FilesystemLoader(VIEWS . DIRECTORY_SEPARATOR. 'posts' );
//        $twig = new \Twig\Environment($loader, []);
//        $template = $twig->load('index.html');
//        echo $template->render(['id' => 1, 'user' => 'Josef']);
        $data = [
            "users" => $users
        ];
        view('posts','index',$data);
    }

    public function show($vars)
    {
echo __METHOD__;
$id = $vars["id"];
//$post = new Post('grej','grejen',7);
$post = new Post();
$post->find($id);
var_dump($post);
//var_dump($vars);
    }

    public function edit()
    {

    }

    public function delete()
    {

    }

    public function update()
    {

    }

    public function add()
    {

    }

    public function store()
    {

    }
}