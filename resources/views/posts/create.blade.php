@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Create New Post</div>

                    <div class="card-body">
                        <form action="/posts" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Choose Image</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image"
                                    accept="image/*" required>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Caption</label>
                                <textarea class="form-control @error('caption') is-invalid @enderror" name="caption"
                                    rows="3"></textarea>
                                @error('caption')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Share Post</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection