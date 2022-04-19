<?php
class Home extends Controller 
{
    public function index()
    {   $data['title'] = 'Selamat Datang Di My Website';
        $this->view('templates/header', $data);
        $this->view('home/index');
        $this->view('templates/footer');
    }
}