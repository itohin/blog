<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Auth\Auth;
use App\Repositories\BlogRepository;
use App\Request\Request;
use App\Session\Session;

class BlogController extends BaseController
{
    protected Request $request;

    protected Session $session;

    protected Auth $auth;

    protected BlogRepository $repository;

    public function __construct(Request $request, Session $session, Auth $auth, BlogRepository $repository)
    {
        parent::__construct($session);
        $this->request = $request;
        $this->session = $session;
        $this->auth = $auth;
        $this->repository = $repository;
    }

    public function index()
    {
        $user = $this->auth->user();
        $posts = $this->repository->all();

        return $this->view('/views/blog/index', compact('user', 'posts'));
    }

    public function show(string $date)
    {
        $user = $this->auth->user();
        $post = $this->repository->find($date);

        return $this->view('/views/blog/show', compact('user', 'post'));
    }

    public function create()
    {
        $user = $this->auth->user();
        if (!$user) {
            return $this->redirect('/');
        }
        return $this->view('/views/blog/create', compact('user'));
    }

    public function store()
    {
        $inputs = $this->request->getBody();
        $valid = $this->validatePost($inputs);
        if (!$valid) {
            return $this->redirect('/addblog');
        }

        $this->repository->create($inputs);
        return $this->redirect('/');
    }

    public function edit(string $date)
    {
        $user = $this->auth->user();
        if (!$user) {
            return $this->redirect('/');
        }
        $post = $this->repository->find($date);

        return $this->view('/views/blog/edit', compact('user', 'post'));
    }

    public function update(string $date)
    {
        $inputs = $this->request->getBody();
        $valid = $this->validatePost($inputs);
        if (!$valid) {
            return $this->redirect('/editblog-' . $date);
        }

        $this->repository->update($date, $inputs);
        return $this->redirect('/blog-' . $date);
    }

    protected function validatePost($inputs)
    {
        if (!$this->auth->user()) {
            return $this->redirect('/');
        }
        $validator = $this->validate($inputs, [
            'title' => ['required', ['min' => 5]],
            'content' => ['required', ['min' => 5]]
        ]);
        if ($validator->hasErrors()) {
            $this->session->set([
                'errors' => $validator->getErrors(),
                'old' => $inputs
            ]);
            return false;
        }
        return true;
    }
}