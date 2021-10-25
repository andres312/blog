@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create post</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form
                        action="{{ route('posts.store') }}"
                        method="POST"
                        enctype="multipart/form-data"
                    >
                        <div class="form-group">
                            <label>Title *</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="write title" require>
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" name ="file">
                        </div>
                        <div class="form-group">
                            <label>Content *</label>
                            <textarea name="body" id="body" rows="6" class="form-control" placeholder="write content" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Embebed content</label>
                            <textarea name="iframe" id="iframe" class="form-control" placeholder="iframe content"></textarea>
                        </div>
                        <div class="form-group">
                            @csrf
                            <input type="submit" value="Save" class="btn btn-sm btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
