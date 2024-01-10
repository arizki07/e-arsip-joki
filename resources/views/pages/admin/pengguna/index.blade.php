@extends('layouts.main')
@section('content')
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Comment</h3>
                    <p class="text-subtitle text-muted">
                        A component that can be used to comment on the content of your website. It can be used to comment on
                        a post, image, or video.
                    </p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Comment</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Data Pengguna</h4>
                </div>
                <div class="card-body">
                    <div class="comment-wrapper">
                        @foreach ($pengguna as $item)
                            <div class="comment">
                                <div class="comment-header">
                                    <div class="pr-50">
                                        <div class="avatar avatar-2xl">
                                            <img src="{{ asset('template/dist/assets/compiled/jpg/2.jpg') }}"
                                                alt="Avatar">
                                        </div>
                                    </div>
                                    <div class="comment-body">

                                        <div class="comment-profileName">{{ $item->name }}</div>
                                        <div class="comment-time">{{ $item->email }}</div>
                                        <div class="comment-message">{{ $item->role }}</div>
                                        <div class="comment-actions">
                                            <button class="btn icon icon-left btn-primary me-2 text-nowrap"><i
                                                    class="bi bi-eye-fill"></i> Show</button>
                                            <button class="btn icon icon-left btn-warning me-2 text-nowrap"><i
                                                    class="bi bi-pencil-square"></i> Edit</button>
                                            <button class="btn icon icon-left btn-danger me-2 text-nowrap"><i
                                                    class="bi bi-x-circle"></i> Remove</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
