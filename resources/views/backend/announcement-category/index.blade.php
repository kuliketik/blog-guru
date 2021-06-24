@extends('layouts.main')

@section('title', 'Kategori Pengumuman')

@section('breadcump')
<div class="col-sm-6">
    <h1 class="m-0">{{ __('Kategori Pengumuman') }}</h1>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">Home</a></li>
        <li class="breadcrumb-item">{{ __('Kategori Pengumuman') }}</li>
    </ol>
</div>
@endsection


@section('main')
@if (session()->has('success'))
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{ session('success') }}
        </div>
    </div>
</div>
@endif
<div class="row">
    @can('tambah kategori pengumuman')
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    {{ __('Form tambah kategori pengumuman') }}
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('backend.announcement.category.store') }}" method="POST">
                    @csrf
                    @include('backend.announcement-category._form')
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-2"></i>
                            {{ __('Simpan') }}
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    @endcan
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    {{ __('Data kategori pengumuman') }}
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>{{ __('Nama kategori') }}</th>
                                <th>{{ __('Tanggal dibuat') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($announcementCategories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->created_at->diffForHumans() }}</td>
                                    <td>
                                        @can('ubah kategori pengumuman')
                                        <a href="{{ route('backend.announcement.category.edit', $category) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit mr-2"></i>
                                            {{ __('Ubah') }}
                                        </a>
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-muted text-center"><i>{{ __('Data kosong') }}</i></td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-3 float-right">
                    {{ $announcementCategories->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
